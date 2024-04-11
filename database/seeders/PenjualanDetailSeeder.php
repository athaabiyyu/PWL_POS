<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'detail_id' => 1,
                'penjualan_id' => 1,
                'barang_id' => 1,
                'harga' => 70000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 2,
                'penjualan_id' => 1,
                'barang_id' => 1,
                'harga' => 33000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 3,
                'penjualan_id' => 1,
                'barang_id' => 2,
                'harga' => 42000,
                'jumlah' => 12,
            ],
        ];
        DB::table('t_penjualan_detail')->insert($data);
    }
}
