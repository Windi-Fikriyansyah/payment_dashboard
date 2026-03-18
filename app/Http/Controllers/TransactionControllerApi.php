<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class TransactionControllerApi extends Controller
{
    /**
     * Display the transactions index page.
     */
    public function index()
    {
        $projects = DB::table('projects')
            ->where('user_id', Auth::id())
            ->get(['id', 'nama', 'slug']);

        return view('transaksi_api.index', compact('projects'));
    }

    /**
     * Fetch transactions for Yajra DataTables.
     */
    public function data(Request $request)
    {
        $transactions = DB::table('transactions')
            ->join('projects', 'transactions.project_id', '=', 'projects.id')
            ->where('projects.user_id', Auth::id())
            ->where(function ($query) {
            $query->where('transactions.jenis', '!=', 'url')
                  ->orWhereNull('transactions.jenis');
        })
            ->select([
                'transactions.id',
                'transactions.project_id',
                'transactions.order_id',
                'transactions.reference',
                'transactions.amount',
                'transactions.fee',
                'transactions.total_payment',
                'transactions.status',
                'transactions.payment_method',
                'transactions.payment_number',
                'transactions.created_at',
                'transactions.mode',
                'projects.nama as nama_proyek'
            ]);

        // Filter by Status
        if ($request->filled('status')) {
            $transactions->where('transactions.status', $request->status);
        }

        // Filter by Mode
        if ($request->filled('mode')) {
            $transactions->where('transactions.mode', $request->mode);
        }

        // Filter by Project
        if ($request->filled('project_id')) {
            $transactions->where('transactions.project_id', $request->project_id);
        }

        return DataTables::of($transactions)
            ->addColumn('tanggal_format', function($row) {
                return date('d M Y, H:i', strtotime($row->created_at));
            })
            ->addColumn('amount_format', function($row) {
                return 'Rp ' . number_format($row->amount, 2, ',', '.');
            })
            ->addColumn('fee_format', function($row) {
                return 'Rp ' . number_format($row->fee, 2, ',', '.');
            })
            ->addColumn('total_format', function($row) {
                return 'Rp ' . number_format($row->total_payment, 2, ',', '.');
            })
            ->addColumn('status_badge', function($row) {
                $color = 'gray';
                $status = strtolower($row->status);
                if ($status === 'success' || $status === 'berhasil' || $status === 'paid') {
                    $color = 'emerald';
                } elseif ($status === 'pending' || $status === 'tertunda') {
                    $color = 'amber';
                } elseif ($status === 'failed' || $status === 'gagal' || $status === 'expired') {
                    $color = 'rose';
                }
                
                return '<span class="px-2.5 py-1 bg-' . $color . '-100 text-' . $color . '-600 rounded-lg text-xs font-bold uppercase tracking-wide">' . $row->status . '</span>';
            })
            ->addColumn('mode_badge', function($row) {
                $color = strtolower($row->mode) === 'production' ? 'rose' : 'blue';
                return '<span class="px-2 py-0.5 bg-' . $color . '-100 text-' . $color . '-600 rounded-md text-[10px] font-bold uppercase">' . $row->mode . '</span>';
            })
            ->addColumn('aksi', function($row) {
                return '<a href="' . route('transaksi_api.show', Crypt::encrypt($row->id)) . '" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-xs font-bold transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail
                        </a>';
            })
            ->filterColumn('created_at', function($query, $keyword) {
                $query->whereRaw("TO_CHAR(transactions.created_at, 'DD Mon YYYY') ILIKE ?", ["%{$keyword}%"]);
            })
            ->rawColumns(['status_badge', 'mode_badge', 'aksi'])
            ->make(true);
    }

    /**
     * Display the specified transaction.
     */
    public function show($id)
    {
        try {
            $realId = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $transaction = DB::table('transactions')
            ->join('projects', 'transactions.project_id', '=', 'projects.id')
            ->where('projects.user_id', Auth::id())
            ->where('transactions.id', $realId)
            ->select([
                'transactions.*',
                'projects.nama as nama_proyek'
            ])
            ->first();

        if (!$transaction) {
            abort(404);
        }

        return view('transaksi_api.show', compact('transaction'));
    }
}
