<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'user_id' => 1,
                'nama' => 'Winkost',
                'slug' => 'winkost',
                'status' => 'Aktif',
                'mode' => 'Production',
                'total_transaksi' => 0,
                'saldo_tertunda' => 0,
                'fee_by_merchant' => false,
                'webhook_url' => '',
                'notifikasi_ke' => '-',
                'api_key' => 'PK_' . Str::random(40),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama' => 'Piknikyuk',
                'slug' => 'piknikyuk',
                'status' => 'Aktif',
                'mode' => 'sandbox',
                'total_transaksi' => 500000,
                'saldo_tertunda' => 25000,
                'fee_by_merchant' => true,
                'webhook_url' => 'https://piknikyuk.com/webhook',
                'notifikasi_ke' => 'email:info@piknikyuk.com',
                'api_key' => 'SB_' . Str::random(40),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('projects')->insert($projects);
    }
}
