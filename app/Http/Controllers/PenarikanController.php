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
    public function index()
    {
        return view('penarikan.index');
    }

    /**
     * Ambil data penarikan untuk DataTables.
     */
    public function data()
    {
        $penarikan = DB::table('penarikan')
            ->where('user_id', Auth::id())
            ->select(['id', 'jumlah', 'fee', 'penerima', 'status', 'created_at']);

        return DataTables::of($penarikan)
            ->editColumn('jumlah', function($row) {
                return 'Rp ' . number_format($row->jumlah, 0, ',', '.');
            })
            ->editColumn('fee', function($row) {
                return 'Rp ' . number_format($row->fee, 0, ',', '.');
            })
            ->editColumn('created_at', function($row) {
                return date('d M Y, H:i', strtotime($row->created_at));
            })
            ->editColumn('status', function($row) {
                $colors = [
                    'Pending' => 'bg-amber-100 text-amber-700',
                    'Sukses' => 'bg-emerald-100 text-emerald-700',
                    'Ditolak' => 'bg-rose-100 text-rose-700',
                ];
                $color = $colors[$row->status] ?? 'bg-gray-100 text-gray-700';
                
                return '<span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider ' . $color . '">' . $row->status . '</span>';
            })
            ->rawColumns(['status'])
            ->make(true);
    }
}
