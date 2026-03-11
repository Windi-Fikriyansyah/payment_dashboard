<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display the transactions index page.
     */
    public function index()
    {
        $projects = DB::table('projects')->where('user_id', Auth::id())->get(['id', 'nama']);

        return view('transaksi.index', compact('projects'));
    }

    /**
     * Fetch transactions for Yajra DataTables.
     */
    public function data(Request $request)
    {
        $transactions = DB::table('transactions')
            ->join('projects', 'transactions.project_id', '=', 'projects.id')
            ->where('projects.user_id', Auth::id())
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
                return 'Rp ' . number_format($row->amount, 0, ',', '.');
            })
            ->addColumn('fee_format', function($row) {
                return 'Rp ' . number_format($row->fee, 0, ',', '.');
            })
            ->addColumn('total_format', function($row) {
                return 'Rp ' . number_format($row->total_payment, 0, ',', '.');
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
            ->filterColumn('created_at', function($query, $keyword) {
                $query->whereRaw("TO_CHAR(transactions.created_at, 'DD Mon YYYY') ILIKE ?", ["%{$keyword}%"]);
            })
            ->rawColumns(['status_badge', 'mode_badge'])
            ->make(true);
    }
}
