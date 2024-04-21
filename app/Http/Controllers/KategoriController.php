<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use JeroenNoten\LaravelAdminLte\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori';

        $kategori = KategoriModel::all();

        return view('kategori.index', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Ambil data kategori dalam bentuk json untuk datatables
    public function list(Request $request) {
        $categories = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        // Filter data kategori berdasarkan kategori_id
        if($request->kategori_id) {
            $categories->where('kategori_id', $request->kategori_id);
        }
        
        return DataTables::of($categories)->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi

            $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/kategori/' . $kategori->kategori_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/kategori/'.$kategori->kategori_id).'">'
            . csrf_field() . method_field('DELETE') .
            '<button type="submit" class="btn btn-danger btn-sm"onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    // Menampilkan halaman form tambah Kategori
    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' =>  ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Kategori baru'
        ];

        $kategori = KategoriModel::all();
        $activeMenu = 'kategori';

        return view('kategori.create', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request) {
        $request->validate(
            [
                'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode',
                'kategori_nama' => 'required|string|max:100',
            ]
        );

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);
        
        return redirect('/kategori')->with('success', 'Data Kategori berhasil di simpan');
    }

    public function show(string $id) {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.show', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id) {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
            'kategori_nama' => 'required|string|max:100',
        ]);

        kategoriModel::find($id)->update(
            [
                'kategori_kode' => $request->kategori_kode,
                'kategori_nama' => $request->kategori_nama,
            ]
        );

        return redirect('/kategori')->with('success', 'Data kategori berhasil di ubah');
    }

    public function destroy(string $id) {

        $check = KategoriModel::find($id);
        if(!$check) { // untuk mengecek data kategori dengan id yang dimaksud ada atau tidak
            return redirect('kategori')->with('erorr', 'Data kategori tidak ditemukan');
        }

        try {
            KategoriModel::destroy($id); // hapus data kategori
            return redirect('kategori')->with('success', 'Data kategori berhasil di hapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // jika terjadi erorr ketika menghapus data
            return redirect('kategori')->with('erorr', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan tabel ini');
        }
    }
}
