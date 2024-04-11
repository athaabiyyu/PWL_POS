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
                'kategori_id' => 2,
                'barang_kode' => 'BRG01',
                'barang_nama' => 'Sprite',
                'harga_beli' => 35000,
                'harga_jual' => 70000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'BRG02',
                'barang_nama' => 'Lays',
                'harga_beli' => 2500,
                'harga_jual' => 4000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
