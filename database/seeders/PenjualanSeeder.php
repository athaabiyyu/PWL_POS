<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Maliki Sutrisno',
                'penjualan_kode' => 'PJ01',
                'penjualan_tanggal' => '2022-12-12',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Ahmad Dayat',
                'penjualan_kode' => 'PJ02',
                'penjualan_tanggal' => '2022-12-12',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 1,
                'pembeli' => 'Rendi Apriyansyah',
                'penjualan_kode' => 'PJ03',
                'penjualan_tanggal' => '2022-12-12',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 2,
                'pembeli' => 'Anggun Indah',
                'penjualan_kode' => 'PJ04',
                'penjualan_tanggal' => '2022-12-12',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 1,
                'pembeli' => 'Prayitno',
                'penjualan_kode' => 'PJ05',
                'penjualan_tanggal' => '2023-01-03',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 2,
                'pembeli' => 'Sri Yuli',
                'penjualan_kode' => 'PJ06',
                'penjualan_tanggal' => '2023-01-13',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Edi Marmudi',
                'penjualan_kode' => 'PJ07',
                'penjualan_tanggal' => '2023-01-19',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Yayat Sunayat',
                'penjualan_kode' => 'PJ08',
                'penjualan_tanggal' => '2023-01-22',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 2,
                'pembeli' => 'Bastomi',
                'penjualan_kode' => 'PJ09',
                'penjualan_tanggal' => '2023-01-22',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 2,
                'pembeli' => 'Rini Dwi',
                'penjualan_kode' => 'PJ10',
                'penjualan_tanggal' => '2023-01-22',
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
