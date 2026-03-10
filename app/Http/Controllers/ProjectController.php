<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    /**
     * Display the projects index page.
     */
    public function index()
    {
        return view('proyek.index');
    }

    /**
     * Store a new project.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'webhook_url' => 'nullable|url|max:255',
        ]);

        $slug = Str::slug($request->nama);
        
        // Ensure slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (DB::table('projects')->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        DB::table('projects')->insert([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'slug' => $slug,
            'webhook_url' => $request->webhook_url,
            'status' => 'Aktif',
            'mode' => 'Sandbox',
            'api_key' => 'SB_' . Str::random(40),
            'total_transaksi' => 0,
            'saldo_tertunda' => 0,
            'fee_by_merchant' => false,
            'notifikasi_ke' => '-',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Proyek berhasil ditambahkan!');
    }

    /**
     * Fetch projects for Yajra DataTables.
     */
    public function data()
    {
        $projects = DB::table('projects')
            ->where('user_id', Auth::id())
            ->select(['id', 'nama', 'slug', 'total_transaksi', 'status']);

        return DataTables::of($projects)
            ->addColumn('total_transaksi_format', function($row) {
                return 'Rp ' . number_format($row->total_transaksi, 0, ',', '.');
            })
            ->addColumn('aksi', function($row) {
                $detailBtn = '<a href="' . route('proyek.show', $row->id) . '" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-xs font-bold hover:bg-blue-600 hover:text-white transition-colors dark:bg-blue-900/30 dark:border-blue-800 dark:text-blue-400 dark:hover:bg-blue-600 dark:hover:text-white">' .
                                '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>' .
                                'Detail' .
                             '</a>';

                $deleteBtn = '<form action="' . route('proyek.destroy', $row->id) . '" method="POST" class="inline-block form-delete">' .
                                csrf_field() .
                                method_field('DELETE') .
                                '<button type="button" class="btn-delete inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 border border-rose-200 rounded-lg text-xs font-bold hover:bg-rose-600 hover:text-white transition-colors dark:bg-rose-900/30 dark:border-rose-800 dark:text-rose-400 dark:hover:bg-rose-600 dark:hover:text-white">' .
                                    '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>' .
                                    'Hapus' .
                                '</button>' .
                             '</form>';

                return '<div class="flex items-center justify-center gap-2">' . $detailBtn . $deleteBtn . '</div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show details of a specific project.
     */
    public function show($id)
    {
        $project = DB::table('projects')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$project) {
            abort(404);
        }

        return view('proyek.show', compact('project'));
    }

    /**
     * Update project (e.g., toggle mode).
     * Added extra logic here per user prompt: api key changes on production mode.
     */
    public function update(Request $request, $id)
    {
        $project = DB::table('projects')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$project) {
            abort(404);
        }

        $updateData = ['updated_at' => now()];

        if ($request->has('mode')) {
            $mode = $request->mode;
            $apiKey = $project->api_key;

            // User requirement: apikey changed when switching to Production or within Production
            if ($mode === 'Production' && $project->mode !== 'Production') {
                $apiKey = 'PK_' . Str::random(40);
            } elseif ($mode === 'Sandbox' && $project->mode !== 'Sandbox') {
                $apiKey = 'SB_' . Str::random(40);
            }

            $updateData['mode'] = $mode;
            $updateData['api_key'] = $apiKey;
        }

        if ($request->has('nama')) {
            $request->validate(['nama' => 'required|string|max:255', 'webhook_url' => 'nullable|url|max:255']);
            $updateData['nama'] = $request->nama;
        }

        if ($request->has('status')) {
            $updateData['status'] = $request->status;
        }

        if ($request->has('fee_by_merchant')) {
            $updateData['fee_by_merchant'] = $request->fee_by_merchant;
        }

        if ($request->has('webhook_url')) {
            $updateData['webhook_url'] = $request->webhook_url;
        }

        if ($request->has('notifikasi_ke')) {
            $updateData['notifikasi_ke'] = $request->notifikasi_ke;
        }

        DB::table('projects')->where('id', $id)->update($updateData);

        return redirect()->back()->with('success', 'Data proyek berhasil diperbarui!');
    }

    /**
     * Delete a specific project.
     */
    public function destroy($id)
    {
        $project = DB::table('projects')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$project) {
            abort(404);
        }

        DB::table('projects')->where('id', $id)->delete();

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil dihapus!');
    }
}
