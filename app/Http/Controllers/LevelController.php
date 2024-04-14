<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LevelRequest;

class LevelController extends Controller
{
    public function index() {
        
        // // insert
        // DB::insert('insert into m_level (level_kode, level_nama, created_at) values (?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        // // update
        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // // delete
        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // show 
        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }

    public function tambah() {
        return view('form.level_form');
    }

    public function tambah_simpan(LevelRequest $request): RedirectResponse {
        // mengambil validasi inout data
        $validated = $request->validated();

        // mengambil sebuah bagian dari validasi input data
        $validated = $request->safe();

        return redirect('/level');
    }
}
