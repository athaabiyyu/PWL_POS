<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar Stok yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok';

        $barang = BarangModel::all();
        $stok = stokModel::all();

        return view('stok.index', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'stok' => $stok,
            'activeMenu' => $activeMenu
        ]);
    }

    // Ambil data stok dalam bentuk json untuk datatables
    public function list(Request $request) {
        $stoks = StokModel::select('stok_id', 'stok_tanggal', 'stok_jumlah', 'barang_id', 'user_id')->with('barang', 'user');

        // Filter data stok berdasarkan barang_id
        if($request->barang_id) {
            $stoks->where('barang_id', $request->barang_id);
        }
        
        return DataTables::of($stoks)->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi

            $btn = '<a href="'.url('/stok/' . $stok->stok_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/stok/'.$stok->stok_id).'">'
            . csrf_field() . method_field('DELETE') .
            '<button type="submit" class="btn btn-danger btn-sm"onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    // Menampilkan halaman form tambah stok
    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' =>  ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Stok baru'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();

        $activeMenu = 'stok';

        return view('stok.create', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request) {
        $request->validate(
            [
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer',
                'barang_id' => 'required|integer',
                'user_id' => 'required|integer'
            ]
        );

        StokModel::create([
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
        ]);
        
        return redirect('/stok')->with('success', 'Data stok berhasil di simpan');
    }

    public function show(string $id) {
        $stok = StokModel::with('barang', 'user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok'
        ];

        $activeMenu = 'stok';

        return view('stok.show', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id) {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

        $stok = StokModel::with('barang', 'user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Stok'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'barang' => $barang,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer',
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        StokModel::find($id)->update(
            [
                'stok_tanggal' => $request->stok_tanggal,
                'stok_jumlah' => $request->stok_jumlah,
                'barang_id' => $request->barang_id,
                'user_id' => $request->user_id,
            ]
        );

        return redirect('/stok')->with('success', 'Data stok berhasil di ubah');
    }

    public function destroy(string $id) {

        $check = StokModel::find($id);
        if(!$check) { // untuk mengecek data stok dengan id yang dimaksud ada atau tidak
            return redirect('stok')->with('erorr', 'Data stok tidak ditemukan');
        }

        try {
            StokModel::destroy($id); // hapus data stok
            return redirect('stok')->with('success', 'Data stok berhasil di hapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // jika terjadi erorr ketika menghapus data
            return redirect('stok')->with('erorr', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan tabel ini');
        }
    }
}
