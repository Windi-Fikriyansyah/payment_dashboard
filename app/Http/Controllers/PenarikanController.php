<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PenarikanController extends Controller
{
    /**
     * Tampilkan halaman utama penarikan.
     */
    /**
     * Tampilkan halaman utama penarikan.
     */
    public function index()
    {
        $user_id = Auth::id();
        $projects = DB::table('projects')
            ->where('user_id', $user_id)
            ->select([
                'id', 
                'nama',
                'mode',
                DB::raw('((SELECT COALESCE(SUM(l.amount), 0) FROM ledgers l JOIN transactions t ON l.transaction_id = t.id WHERE l.project_id = projects.id AND t.status = \'success\' AND t.mode = \'production\' AND l.type = \'credit\') - (SELECT COALESCE(SUM(l.amount), 0) FROM ledgers l JOIN penarikan p ON l.penarikan_id = p.id WHERE l.project_id = projects.id AND p.status != \'Ditolak\' AND p.mode = \'production\' AND l.type = \'debit\')) as saldo')
            ])
            ->get();
        $bank_accounts = DB::table('rekening_bank')->where('user_id', $user_id)->get(['id', 'bank_name', 'account_number', 'account_name']);

        return view('penarikan.index', compact('projects', 'bank_accounts'));
    }

    /**
     * Simpan request penarikan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer',
            'rekening_bank_id' => 'required|integer',
            'jumlah' => 'required|numeric|min:10000',
        ]);

        $user_id = Auth::id();
        $project_id = $request->project_id;
        $rekening_id = $request->rekening_bank_id;
        $amount = (int) $request->jumlah;

        return DB::transaction(function () use ($user_id, $project_id, $rekening_id, $amount) {
            // 1. Lock the project to prevent race conditions on balance
            $project = DB::table('projects')
                ->where('id', $project_id)
                ->where('user_id', $user_id)
                ->lockForUpdate()
                ->first();

            if (!$project) {
                return response()->json(['success' => false, 'message' => 'Proyek tidak ditemukan'], 404);
            }
            // Balance is always based on Production mode
            $target_mode = 'production';

            // 2. Lock bank account
            $bank_account = DB::table('rekening_bank')
                ->where('id', $rekening_id)
                ->where('user_id', $user_id)
                ->first();

            if (!$bank_account) {
                return response()->json(['success' => false, 'message' => 'Rekening bank tidak ditemukan'], 404);
            }

            // 3. Calculate current balance
            // Credits: only from success transactions in Production mode
            $credits = DB::table('ledgers')
                ->join('transactions', 'ledgers.transaction_id', '=', 'transactions.id')
                ->where('ledgers.project_id', $project_id)
                ->where('transactions.status', 'success')
                ->where('transactions.mode', $target_mode)
                ->where('ledgers.type', 'credit')
                ->sum('ledgers.amount');

            // Debits: join with penarikan table filtered by Production mode
            $debits = DB::table('ledgers')
                ->join('penarikan', 'ledgers.penarikan_id', '=', 'penarikan.id')
                ->where('ledgers.project_id', $project_id)
                ->where('penarikan.mode', $target_mode)
                ->where('penarikan.status', '!=', 'Ditolak')
                ->where('ledgers.type', 'debit')
                ->sum('ledgers.amount');

            $current_balance = $credits - $debits;

            if ($current_balance < $amount) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Saldo tidak mencukupi. Saldo saat ini: Rp ' . number_format($current_balance, 0, ',', '.')
                ], 422);
            }

            // 4. Create Penarikan Record
            $fee = 4000;
            $net_amount = $amount - $fee;
            $penerima = "{$bank_account->bank_name} - {$bank_account->account_number} ({$bank_account->account_name})";
            $penarikan_id = DB::table('penarikan')->insertGetId([
                'user_id' => $user_id,
                'project_id' => $project_id,
                'rekening_bank_id' => $rekening_id,
                'jumlah' => $amount,
                'fee' => $fee,
                'total_terima' => $net_amount,
                'mode' => $target_mode,
                'penerima' => $penerima,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 5. Insert into Ledgers (Debit)
            DB::table('ledgers')->insert([
                'project_id' => $project_id,
                'transaction_id' => null,
                'penarikan_id' => $penarikan_id,
                'amount' => $amount,
                'type' => 'debit',
                'description' => "Penarikan Dana #{$penarikan_id} (Net: Rp " . number_format($net_amount, 0, ',', '.') . " ke {$penerima})",
                'created_at' => now(),
            ]);

            // 6. Insert into Audit Logs
            DB::table('audit_logs')->insert([
                'project_id' => $project_id,
                'transaction_id' => null,
                'penarikan_id' => $penarikan_id,
                'before_balance' => $current_balance,
                'after_balance' => $current_balance - $amount,
                'amount' => $amount,
                'type' => 'debit',
                'created_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Permintaan penarikan berhasil diajukan!'
            ]);
        });
    }

    /**
     * Ambil data penarikan untuk DataTables.
     */
    public function data()
    {
        $penarikan = DB::table('penarikan')
            ->where('user_id', Auth::id())
            ->select(['id', 'jumlah', 'fee', 'total_terima', 'penerima', 'status', 'created_at']);

        return DataTables::of($penarikan)
            ->editColumn('jumlah', function($row) {
                return 'Rp ' . number_format($row->jumlah, 0, ',', '.');
            })
            ->editColumn('fee', function($row) {
                return 'Rp ' . number_format($row->fee, 0, ',', '.');
            })
            ->editColumn('total_terima', function($row) {
                return 'Rp ' . number_format($row->total_terima, 0, ',', '.');
            })
            ->editColumn('created_at', function($row) {
                return date('d M Y, H:i', strtotime($row->created_at));
            })
            ->editColumn('status', function($row) {
                $status = strtolower($row->status);
                if ($status === 'pending') {
                    return '<span class="px-2.5 py-1 bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400 rounded-lg text-xs font-bold uppercase tracking-wide">Pending</span>';
                } elseif ($status === 'sukses') {
                    return '<span class="px-2.5 py-1 bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-lg text-xs font-bold uppercase tracking-wide">Sukses</span>';
                } elseif ($status === 'ditolak') {
                    return '<span class="px-2.5 py-1 bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400 rounded-lg text-xs font-bold uppercase tracking-wide">Ditolak</span>';
                }
                
                return '<span class="px-2.5 py-1 bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 rounded-lg text-xs font-bold uppercase tracking-wide">' . $row->status . '</span>';
            })
            ->rawColumns(['status'])
            ->make(true);
    }
}
