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
                'transactions.tanggal',
                'transactions.order_id',
                'transactions.status',
                'transactions.jumlah',
                'projects.nama as nama_proyek'
            ]);

        // Filter by Status
        if ($request->filled('status')) {
            $transactions->where('transactions.status', $request->status);
        }

        // Filter by Project
        if ($request->filled('project_id')) {
            $transactions->where('transactions.project_id', $request->project_id);
        }

        return DataTables::of($transactions)
            ->addColumn('tanggal_format', function($row) {
                return date('d M Y, H:i', strtotime($row->tanggal));
            })
            ->addColumn('jumlah_format', function($row) {
                return 'Rp ' . number_format($row->jumlah, 0, ',', '.');
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
            ->filterColumn('tanggal', function($query, $keyword) {
                // Gunakan TO_CHAR yang kompatibel dengan PostgreSQL alih-alih DATE_FORMAT(MySQL)
                $query->whereRaw("TO_CHAR(transactions.tanggal, 'DD Mon YYYY') ILIKE ?", ["%{$keyword}%"]);
            })
            ->rawColumns(['status_badge'])
            ->make(true);
    }
}
