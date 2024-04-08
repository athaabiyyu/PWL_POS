<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'ktg01',
                'kategori_nama' => 'Perabotan',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'ktg02',
                'kategori_nama' => 'Pecah Belah',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'ktg03',
                'kategori_nama' => 'Elektronik',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'ktg04',
                'kategori_nama' => 'Pakaian',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'ktg05',
                'kategori_nama' => 'Audio',
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
