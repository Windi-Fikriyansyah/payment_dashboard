<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class RekeningBankController extends Controller
{
    /**
     * Display the index page for Rekening Bank.
     */
    public function index()
    {
        $count = DB::table('rekening_bank')->where('user_id', Auth::id())->count();
        
        // Fetch bank list from Duitku (using sandbox for now or default to common Indonesian banks if API fails)
        // Usually, Duitku Disbursement API requires merchantCode and signature, 
        // but often the bank list is relatively static or can be cached.
        // For this task, I'll provide a helper to fetch it.
        $banks = $this->getDuitkuBanks();

        return view('rekening_bank.index', compact('count', 'banks'));
    }

    /**
     * Fetch bank accounts for DataTables.
     */
    public function data()
    {
        $accounts = DB::table('rekening_bank')
            ->where('user_id', Auth::id())
            ->select(['id', 'bank_name', 'account_number', 'account_name', 'status', 'created_at']);

        return DataTables::of($accounts)
            ->addColumn('aksi', function($row) {
                return '<button onclick="confirmDelete(' . $row->id . ')" class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 border border-rose-200 rounded-lg text-xs font-bold hover:bg-rose-100 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>';
            })
            ->editColumn('created_at', function($row) {
                return date('d M Y, H:i', strtotime($row->created_at));
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Store a new bank account.
     */
    public function store(Request $request)
    {
        $count = DB::table('rekening_bank')->where('user_id', Auth::id())->count();
        if ($count >= 5) {
            return redirect()->back()->with('error', 'Anda hanya dapat menambahkan maksimal 5 rekening bank.');
        }

        $request->validate([
            'bank_code' => 'required',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:255',
        ]);

        // Find bank name from the list
        $banks = $this->getDuitkuBanks();
        $bankName = 'Unknown Bank';
        foreach ($banks as $bank) {
            if ($bank['bankCode'] == $request->bank_code) {
                $bankName = $bank['bankName'];
                break;
            }
        }

        DB::table('rekening_bank')->insert([
            'user_id' => Auth::id(),
            'bank_name' => $bankName,
            'bank_code' => $request->bank_code,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Rekening bank berhasil ditambahkan!');
    }

    /**
     * Delete a bank account.
     */
    public function destroy($id)
    {
        DB::table('rekening_bank')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Helper to get bank list from Duitku.
     */
    private function getDuitkuBanks()
    {
        // Try to fetch from Duitku Sandbox Bank List (Disbursement)
        try {
            // Updated URL to correct Duitku API endpoint
            $response = Http::timeout(5)->get('https://api-sandbox.duitku.com/webapi/api/disbursement/banklist');
            
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['bankList']) && count($data['bankList']) > 0) {
                    return $data['bankList'];
                }
            }
        } catch (\Exception $e) {
            // Log if needed: \Log::error('Duitku API Error: ' . $e->getMessage());
        }

        // Expanded Fallback List based on Duitku/Indonesian Bank Codes provided by user
        return [
            ['bankCode' => '002', 'bankName' => 'Bank BRI'],
            ['bankCode' => '008', 'bankName' => 'Bank Mandiri'],
            ['bankCode' => '009', 'bankName' => 'Bank BNI'],
            ['bankCode' => '011', 'bankName' => 'Bank Danamon'],
            ['bankCode' => '013', 'bankName' => 'Bank Permata'],
            ['bankCode' => '014', 'bankName' => 'Bank Central Asia'],
            ['bankCode' => '016', 'bankName' => 'Bank Maybank Indonesia'],
            ['bankCode' => '019', 'bankName' => 'Bank Panin'],
            ['bankCode' => '022', 'bankName' => 'CIMB Niaga'],
            ['bankCode' => '023', 'bankName' => 'Bank UOB Indonesia'],
            ['bankCode' => '028', 'bankName' => 'Bank OCBC NISP'],
            ['bankCode' => '031', 'bankName' => 'Citi Bank'],
            ['bankCode' => '036', 'bankName' => 'Bank CCB (Ex-Bank Windu Kentjana)'],
            ['bankCode' => '037', 'bankName' => 'Bank Artha Graha'],
            ['bankCode' => '042', 'bankName' => 'MUFG Bank'],
            ['bankCode' => '046', 'bankName' => 'Bank DBS'],
            ['bankCode' => '050', 'bankName' => 'Standard Chartered Bank'],
            ['bankCode' => '054', 'bankName' => 'Bank Capital'],
            ['bankCode' => '061', 'bankName' => 'ANZ Indonesia'],
            ['bankCode' => '069', 'bankName' => 'Bank Of China Indonesia'],
            ['bankCode' => '076', 'bankName' => 'Bank Bumi Arta'],
            ['bankCode' => '087', 'bankName' => 'Bank HSBC Indonesia'],
            ['bankCode' => '095', 'bankName' => 'Bank JTrust Indonesia'],
            ['bankCode' => '097', 'bankName' => 'Bank Mayapada'],
            ['bankCode' => '110', 'bankName' => 'Bank BJB'],
            ['bankCode' => '111', 'bankName' => 'Bank DKI'],
            ['bankCode' => '112', 'bankName' => 'Bank BPD DIY'],
            ['bankCode' => '113', 'bankName' => 'Bank Jateng'],
            ['bankCode' => '114', 'bankName' => 'Bank Jatim'],
            ['bankCode' => '115', 'bankName' => 'Bank Jambi'],
            ['bankCode' => '116', 'bankName' => 'Bank Aceh'],
            ['bankCode' => '117', 'bankName' => 'Bank Sumut'],
            ['bankCode' => '118', 'bankName' => 'Bank Nagari'],
            ['bankCode' => '119', 'bankName' => 'Bank Riau Kepri'],
            ['bankCode' => '120', 'bankName' => 'Bank Sumsel Babel'],
            ['bankCode' => '121', 'bankName' => 'Bank Lampung'],
            ['bankCode' => '122', 'bankName' => 'Bank Kalsel'],
            ['bankCode' => '123', 'bankName' => 'Bank Kalbar'],
            ['bankCode' => '124', 'bankName' => 'Bank Kaltimtara'],
            ['bankCode' => '125', 'bankName' => 'Bank Kalteng'],
            ['bankCode' => '126', 'bankName' => 'Bank Sulselbar'],
            ['bankCode' => '127', 'bankName' => 'Bank Sulut Go'],
            ['bankCode' => '128', 'bankName' => 'Bank NTB Syariah'],
            ['bankCode' => '129', 'bankName' => 'Bank BPD Bali'],
            ['bankCode' => '130', 'bankName' => 'Bank NTT'],
            ['bankCode' => '131', 'bankName' => 'Bank Maluku Malut'],
            ['bankCode' => '132', 'bankName' => 'Bank Papua'],
            ['bankCode' => '133', 'bankName' => 'Bank Bengkulu'],
            ['bankCode' => '134', 'bankName' => 'Bank Sulteng'],
            ['bankCode' => '135', 'bankName' => 'Bank Sultra'],
            ['bankCode' => '137', 'bankName' => 'Bank Banten'],
            ['bankCode' => '146', 'bankName' => 'Bank Of India Indonesia'],
            ['bankCode' => '147', 'bankName' => 'Bank Muamalat Indonesia'],
            ['bankCode' => '151', 'bankName' => 'Bank Mestika'],
            ['bankCode' => '152', 'bankName' => 'Bank Shinhan Indonesia'],
            ['bankCode' => '153', 'bankName' => 'Bank Sinarmas'],
            ['bankCode' => '157', 'bankName' => 'Bank Maspion Indonesia'],
            ['bankCode' => '161', 'bankName' => 'Bank Ganesha'],
            ['bankCode' => '164', 'bankName' => 'Bank ICBC Indonesia'],
            ['bankCode' => '167', 'bankName' => 'Bank QNB Indonesia'],
            ['bankCode' => '200', 'bankName' => 'Bank BTN'],
            ['bankCode' => '212', 'bankName' => 'Bank Woori Saudara'],
            ['bankCode' => '213', 'bankName' => 'Bank BTPN'],
            ['bankCode' => '405', 'bankName' => 'Bank Victoria Syariah'],
            ['bankCode' => '425', 'bankName' => 'Bank BJB Syariah'],
            ['bankCode' => '426', 'bankName' => 'Bank Mega'],
            ['bankCode' => '441', 'bankName' => 'Bank KB Bukopin'],
            ['bankCode' => '451', 'bankName' => 'Bank Syariah Indonesia'],
            ['bankCode' => '459', 'bankName' => 'Bank KROOM'],
            ['bankCode' => '472', 'bankName' => 'Bank Jasa Jakarta'],
            ['bankCode' => '484', 'bankName' => 'Bank KEB Hana'],
            ['bankCode' => '485', 'bankName' => 'MNC Bank'],
            ['bankCode' => '490', 'bankName' => 'Bank Neo Commerce'],
            ['bankCode' => '494', 'bankName' => 'Bank BRI Agroniaga'],
            ['bankCode' => '498', 'bankName' => 'Bank SBI'],
            ['bankCode' => '501', 'bankName' => 'Bank Digital BCA'],
            ['bankCode' => '503', 'bankName' => 'Bank Nobu'],
            ['bankCode' => '506', 'bankName' => 'Bank Mega Syariah'],
            ['bankCode' => '513', 'bankName' => 'Bank Ina Perdana'],
            ['bankCode' => '517', 'bankName' => 'Bank Panin Dubai Syariah'],
            ['bankCode' => '520', 'bankName' => 'Bank Prima Master'],
            ['bankCode' => '521', 'bankName' => 'Bank Syariah Bukopin'],
            ['bankCode' => '523', 'bankName' => 'Bank Sahabat Sampoerna'],
            ['bankCode' => '526', 'bankName' => 'Bank Oke Indonesia'],
            ['bankCode' => '531', 'bankName' => 'AMAR BANK'],
            ['bankCode' => '535', 'bankName' => 'SEA Bank'],
            ['bankCode' => '536', 'bankName' => 'Bank BCA Syariah'],
            ['bankCode' => '542', 'bankName' => 'Bank Jago'],
            ['bankCode' => '547', 'bankName' => 'Bank BTPN Syariah'],
            ['bankCode' => '548', 'bankName' => 'Bank Multiarta Sentosa'],
            ['bankCode' => '553', 'bankName' => 'Bank Mayora'],
            ['bankCode' => '555', 'bankName' => 'Bank Index Selindo'],
            ['bankCode' => '562', 'bankName' => 'Superbank (FAMA)'],
            ['bankCode' => '564', 'bankName' => 'Bank Mantap'],
            ['bankCode' => '566', 'bankName' => 'Bank Victoria International'],
            ['bankCode' => '567', 'bankName' => 'Allo Bank'],
            ['bankCode' => '600', 'bankName' => 'BPR SUPRA'],
            ['bankCode' => '688', 'bankName' => 'BPR KS'],
            ['bankCode' => '699', 'bankName' => 'BPR EKA'],
            ['bankCode' => '789', 'bankName' => 'IMkas'],
            ['bankCode' => '911', 'bankName' => 'LinkAja'],
            ['bankCode' => '945', 'bankName' => 'Bank Agris'],
            ['bankCode' => '947', 'bankName' => 'Bank Aladin Syariah'],
            ['bankCode' => '949', 'bankName' => 'Bank CTBC'],
            ['bankCode' => '950', 'bankName' => 'Bank Commonwealth'],
            ['bankCode' => '1010', 'bankName' => 'OVO'],
            ['bankCode' => '1011', 'bankName' => 'Gopay'],
            ['bankCode' => '1012', 'bankName' => 'DANA'],
            ['bankCode' => '1013', 'bankName' => 'Shopeepay'],
        ];
    }
}
