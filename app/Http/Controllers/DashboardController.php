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

        // 1. Total Saldo (Production Mode only)
        $stats = DB::table('projects')
            ->where('user_id', $user_id)
            ->where('mode', 'production')
            ->select([
                DB::raw('SUM((SELECT COALESCE(SUM(l.amount), 0) FROM ledgers l JOIN transactions t ON l.transaction_id = t.id WHERE l.project_id = projects.id AND t.status = \'success\' AND t.mode = \'production\' AND l.type = \'credit\') - (SELECT COALESCE(SUM(l.amount), 0) FROM ledgers l JOIN penarikan p ON l.penarikan_id = p.id WHERE l.project_id = projects.id AND p.status != \'Ditolak\' AND p.mode = \'production\' AND l.type = \'debit\')) as total_saldo')
            ])
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
            ->where('user_id', $user_id)
            ->where('status', 'Pending')
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
