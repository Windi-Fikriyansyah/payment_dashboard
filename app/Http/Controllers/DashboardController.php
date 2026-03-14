<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard overview.
     */
    public function index()
{
    $user_id = Auth::id();

    // 1. Total Saldo (Production Only + User Login)
    $stats = DB::table('ledgers as l')
        ->leftJoin('transactions as t', 'l.transaction_id', '=', 't.id')
        ->leftJoin('penarikan as p', 'l.penarikan_id', '=', 'p.id')
        ->leftJoin('projects as pr', function ($join) {
            $join->on('t.project_id', '=', 'pr.id')
                 ->orOn('p.project_id', '=', 'pr.id');
        })
        ->where('pr.user_id', $user_id)
        ->selectRaw("
            SUM(
                CASE 
                    WHEN l.type = 'credit' AND t.status = 'success' AND t.mode = 'production' THEN l.amount
                    WHEN l.type = 'debit' AND p.status != 'Ditolak' AND p.mode = 'production' THEN -l.amount
                    ELSE 0
                END
            ) as total_saldo
        ")
        ->first();

    $total_saldo = $stats->total_saldo ?? 0;

    // 2. Total Transaksi Berhasil (Production)
    $total_transaksi = DB::table('transactions')
        ->join('projects', 'transactions.project_id', '=', 'projects.id')
        ->where('projects.user_id', $user_id)
        ->where('transactions.status', 'success')
        ->where('transactions.mode', 'production')
        ->count();

    // 3. Penarikan Pending
    $penarikan_pending = DB::table('penarikan')
        ->join('projects', 'penarikan.project_id', '=', 'projects.id')
        ->where('projects.user_id', $user_id)
        ->where('penarikan.status', 'Pending')
        ->count();

    // 4. Total Proyek
    $total_proyek = DB::table('projects')
        ->where('user_id', $user_id)
        ->count();

    return view('dashboard', [
        'total_saldo' => $total_saldo,
        'total_transaksi' => $total_transaksi,
        'penarikan_pending' => $penarikan_pending,
        'total_proyek' => $total_proyek
    ]);
}
}
