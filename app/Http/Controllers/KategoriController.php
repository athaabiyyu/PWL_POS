<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable) {
        return $dataTable->render('kategori.index');
    }   

    public function create() {
        return view('kategori.create');
    }

    public function store(Request $request): RedirectResponse {
        // validate
        // $validated = $request->validate(
        //     [
        //         'kategori_kode' => 'required|min:4',
        //         'kategori_nama' => 'required',
        //     ]
        // );

        // validateWithBag
        // $validated = $request->validateWithBag('default',
        //         [
        //             'kategori_kode' => 'required',
        //             'kategori_nama' => 'required',
        //         ]
        //     );

        // validate-bail
        $validated = $request->validate(
            [
                'kategori_kode' => 'bail|required|min:4',
                'kategori_nama' => 'required',
            ]);

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
