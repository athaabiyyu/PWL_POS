<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use JeroenNoten\LaravelAdminLte\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable) {
        return $dataTable->render('kategori.index');
    }   

    public function create() {
        return view('kategori.create');
    }

    public function store(StorePostRequest $request): RedirectResponse {
        
        // mengambil validasi inout data
        $validated = $request->validated();

        // mengambil sebuah bagian dari validasi input data
        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);

        return redirect('/kategori');
    }

    public function viewEdit(KategoriModel $kategori) {
        return view('kategori.edit_view', ['kategori' => $kategori]);
    }

    public function edit(Request $request, KategoriModel $kategori) {
        $kategori->update([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }
    
    public function delete(KategoriModel $kategori) {
        $kategori->delete();
        return redirect('/kategori');
    }
}
