<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 4,
                'barang_kode' => 'BRG01',
                'barang_nama' => 'Celana Jeans',
                'harga_beli' => 35000,
                'harga_jual' => 70000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'BRG02',
                'barang_nama' => 'Gayung',
                'harga_beli' => 2500,
                'harga_jual' => 4000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1,
                'barang_kode' => 'BRG03',
                'barang_nama' => 'Kursi',
                'harga_beli' => 7000,
                'harga_jual' => 11000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'BRG04',
                'barang_nama' => 'Piring',
                'harga_beli' => 1500,
                'harga_jual' => 3000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 2,
                'barang_kode' => 'BRG05',
                'barang_nama' => 'Mangkok',
                'harga_beli' => 2000,
                'harga_jual' => 3500,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 2,
                'barang_kode' => 'BRG06',
                'barang_nama' => 'Teko',
                'harga_beli' => 5500,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 3,
                'barang_kode' => 'BRG07',
                'barang_nama' => 'TV LED',
                'harga_beli' => 950000,
                'harga_jual' => 1100000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 3,
                'barang_kode' => 'BRG08',
                'barang_nama' => 'Radio',
                'harga_beli' => 450000,
                'harga_jual' => 675000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 4,
                'barang_kode' => 'BRG09',
                'barang_nama' => 'Kemeja',
                'harga_beli' => 55000,
                'harga_jual' => 120000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'BRG10',
                'barang_nama' => 'Speaker JBL',
                'harga_beli' => 90000,
                'harga_jual' => 130000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
