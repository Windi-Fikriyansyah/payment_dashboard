<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
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
            'bot_whatsapp' => 'nullable|boolean',
            'no_whatsapp' => 'required_if:bot_whatsapp,1|nullable|string|regex:/^62[0-9]+$/|unique:projects,no_whatsapp',
        ], [
            'no_whatsapp.regex' => 'Nomor WhatsApp harus diawali dengan 62.',
            'no_whatsapp.required_if' => 'Nomor WhatsApp wajib diisi jika Bot WhatsApp aktif.',
            'no_whatsapp.unique' => 'Nomor WhatsApp sudah digunakan.',
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
            'mode' => 'sandbox',
            'api_key' => 'SB_' . Str::random(40),
            'total_transaksi' => 0,
            'saldo_tertunda' => 0,
            'fee_by_merchant' => false,
            'notifikasi_ke' => '-',
            'bot_whatsapp' => $request->has('bot_whatsapp') ? (bool)$request->bot_whatsapp : false,
            'no_whatsapp' => $request->no_whatsapp,
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
            ->select([
            'id',
            'nama',
            'slug',
            'status',
            'mode',
            DB::raw('((SELECT COALESCE(SUM(l.amount), 0) FROM ledgers l JOIN transactions t ON l.transaction_id = t.id WHERE l.project_id = projects.id AND t.status = \'success\' AND t.mode = projects.mode AND l.type = \'credit\') - (SELECT COALESCE(SUM(l.amount), 0) FROM ledgers l JOIN penarikan p ON l.penarikan_id = p.id WHERE l.project_id = projects.id AND p.status != \'Ditolak\' AND p.mode = projects.mode AND l.type = \'debit\')) as total_transaksi')
        ]);

        return DataTables::of($projects)
            ->addColumn('total_transaksi_format', function ($row) {
            return 'Rp ' . number_format($row->total_transaksi, 0, ',', '.');
        })
            ->addColumn('aksi', function ($row) {
            $encrypted_id = Crypt::encryptString($row->id);
            $detailBtn = '<a href="' . route('proyek.show', $encrypted_id) . '" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-xs font-bold hover:bg-blue-100 hover:text-blue-700 transition-colors dark:bg-blue-900/30 dark:border-blue-800 dark:text-blue-400 dark:hover:bg-blue-800 dark:hover:text-blue-300">' .
                '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>' .
                'Detail' .
                '</a>';

            $paymentBtn = '<a href="' . route('proyek.pembayaran', $encrypted_id) . '" class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-lg text-xs font-bold hover:bg-emerald-100 hover:text-emerald-700 transition-colors dark:bg-emerald-900/30 dark:border-emerald-800 dark:text-emerald-400 dark:hover:bg-emerald-800 dark:hover:text-emerald-300">' .
                '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>' .
                'Pembayaran' .
                '</a>';

            return '<div class="flex items-center justify-center gap-2">' . $detailBtn . $paymentBtn . '</div>';
        })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show details of a specific project.
     */
    public function show($id_encrypted)
    {
        try {
            $id = Crypt::decryptString($id_encrypted);
        }
        catch (DecryptException $e) {
            abort(404);
        }

        $project = DB::table('projects')
            ->where('projects.id', $id)
            ->where('projects.user_id', Auth::id())
            ->select([
            'projects.*',
            DB::raw('((SELECT COALESCE(SUM(l.amount), 0) FROM ledgers l JOIN transactions t ON l.transaction_id = t.id WHERE l.project_id = projects.id AND t.status = \'success\' AND t.mode = projects.mode AND l.type = \'credit\') - (SELECT COALESCE(SUM(l.amount), 0) FROM ledgers l JOIN penarikan p ON l.penarikan_id = p.id WHERE l.project_id = projects.id AND p.status != \'Ditolak\' AND p.mode = projects.mode AND l.type = \'debit\')) as total_transaksi')
        ])
            ->first();

        if (!$project) {
            abort(404);
        }

        $project->encrypted_id = $id_encrypted;

        return view('proyek.show', compact('project'));
    }

    /**
     * Update project (e.g., toggle mode).
     * Added extra logic here per user prompt: api key changes on production mode.
     */
    public function update(Request $request, $id_encrypted)
    {
        try {
            $id = Crypt::decryptString($id_encrypted);
        }
        catch (DecryptException $e) {
            abort(404);
        }

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

            // User requirement: apikey changed when switching to production or within production
            if ($mode === 'production' && $project->mode !== 'production') {
                $apiKey = 'PK_' . Str::random(40);
            }
            elseif ($mode === 'sandbox' && $project->mode !== 'sandbox') {
                $apiKey = 'SB_' . Str::random(40);
            }

            $updateData['mode'] = $mode;
            $updateData['api_key'] = $apiKey;
        }

        if ($request->has('nama')) {
            $request->validate([
                'nama' => 'required|string|max:255',
                'webhook_url' => 'nullable|url|max:255',
                'bot_whatsapp' => 'nullable|boolean',
                'no_whatsapp' => "required_if:bot_whatsapp,1|nullable|string|regex:/^62[0-9]+$/|unique:projects,no_whatsapp,{$id}",
            ], [
                'no_whatsapp.regex' => 'Nomor WhatsApp harus diawali dengan 62.',
                'no_whatsapp.required_if' => 'Nomor WhatsApp wajib diisi jika Bot WhatsApp aktif.',
                'no_whatsapp.unique' => 'Nomor WhatsApp sudah digunakan oleh proyek lain.',
            ]);
            $updateData['nama'] = $request->nama;
            $updateData['bot_whatsapp'] = $request->has('bot_whatsapp') ? (bool)$request->bot_whatsapp : false;
            $updateData['no_whatsapp'] = $request->no_whatsapp;
            if ($request->has('webhook_url')) {
                $updateData['webhook_url'] = $request->webhook_url;
            }
        }

        if ($request->has('status')) {
            $updateData['status'] = $request->status;
        }

        if ($request->has('fee_by_merchant')) {
            $updateData['fee_by_merchant'] = $request->fee_by_merchant;
        }

        if ($request->has('webhook_url') && !$request->has('nama')) {
            $updateData['webhook_url'] = $request->webhook_url;
        }

        if ($request->has('notifikasi_ke')) {
            $updateData['notifikasi_ke'] = $request->notifikasi_ke;
        }

        if ($request->has('bot_whatsapp_toggle')) {
            $updateData['bot_whatsapp'] = $request->bot_whatsapp == '1' ? true : false;
            if (!$updateData['bot_whatsapp']) {
                $updateData['no_whatsapp'] = null;
            }
        }

        DB::table('projects')->where('id', $id)->update($updateData);

        return redirect()->back()->with('success', 'Data proyek berhasil diperbarui!');
    }

    /**
     * Delete a specific project.
     */
    public function destroy($id_encrypted)
    {
        try {
            $id = Crypt::decryptString($id_encrypted);
        }
        catch (DecryptException $e) {
            abort(404);
        }

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

    /**
     * Show manage payment methods page for a specific project.
     */
    public function paymentMethods($id_encrypted)
    {
        try {
            $id = Crypt::decryptString($id_encrypted);
        }
        catch (DecryptException $e) {
            abort(404);
        }

        $project = DB::table('projects')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$project) {
            abort(404);
        }

        $project->encrypted_id = $id_encrypted;

        // Get all active payment methods and check current project's status
        $payment_methods = DB::table('payment_methods')
            ->where('is_active', true)
            ->get()
            ->map(function ($method) use ($id) {
            // Cast to int for safe comparison
            $method->is_enabled = DB::table('project_payment_methods')
                ->where('project_id', (int)$id)
                ->where('payment_method_id', (int)$method->id)
                ->exists();
            return $method;
        });

        return view('proyek.pembayaran', compact('project', 'payment_methods'));
    }

    /**
     * Toggle a payment method for a specific project.
     */
    public function togglePaymentMethod(Request $request, $id_encrypted)
    {
        try {
            $id = Crypt::decryptString($id_encrypted);
        }
        catch (DecryptException $e) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 404);
        }

        $project = DB::table('projects')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$project) {
            return response()->json(['success' => false, 'message' => 'Project not found'], 404);
        }

        $method_id = (int)$request->payment_method_id;

        $already_linked = DB::table('project_payment_methods')
            ->where('project_id', (int)$id)
            ->where('payment_method_id', $method_id)
            ->first();

        if ($already_linked) {
            // "OFF": remove from project_payment_methods
            DB::table('project_payment_methods')
                ->where('project_id', (int)$id)
                ->where('payment_method_id', $method_id)
                ->delete();
            $new_status = false;
            $message = 'Metode pembayaran dinonaktifkan untuk proyek ini.';
        }
        else {
            // "ON": add to project_payment_methods
            DB::table('project_payment_methods')->insert([
                'project_id' => (int)$id,
                'payment_method_id' => $method_id,
                'created_at' => now(),
            ]);
            $new_status = true;
            $message = 'Metode pembayaran diaktifkan untuk proyek ini.';
        }

        return response()->json([
            'success' => true,
            'is_enabled' => $new_status,
            'message' => $message
        ]);
    }
}
