<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Yajra\DataTables\DataTables;
use JeroenNoten\LaravelAdminLte\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();

        return view('Penjualan.index', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    // Ambil data Penjualan dalam bentuk json untuk datatables
    public function list(Request $request) {
        $penjualans = PenjualanModel::select('penjualan_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal', 'user_id')->with('user');

        // Filter data Penjualan berdasarkan user_id
        if($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }
        
        return DataTables::of($penjualans)->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi

            $btn = '<a href="'.url('/penjualan/' . $penjualan->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/penjualan/' . $penjualan->penjualan_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/penjualan/'.$penjualan->penjualan_id).'">'
            . csrf_field() . method_field('DELETE') .
            '<button type="submit" class="btn btn-danger btn-sm"onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    // Menampilkan halaman form tambah penjualan
    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' =>  ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah penjualan baru'
        ];

        $user = UserModel::all();

        $activeMenu = 'penjualan';

        return view('penjualan.create', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request) {
        $request->validate(
            [
                'penjualan_kode' => 'required|string|min:3|unique:t_penjualan,penjualan_kode',
                'pembeli' => 'required|string|max:100',
                'penjualan_tanggal' => 'required|date',
                'user_id' => 'required|integer'
            ]
        );

        PenjualanModel::create([
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'user_id' => $request->user_id
        ]);
        
        return redirect('/penjualan')->with('success', 'Data user berhasil di simpan');
    }

    public function show(string $id) {
        $penjualan = PenjualanModel::with('user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id) {
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::all();

        $penjualan = PenjualanModel::with('user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit penjualan'
        ];

        $activeMenu = 'penjualanr';

        return view('penjualan.edit', 
        [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'penjualan_kode' => 'required|string|min:3|unique:t_penjualan,penjualan_kode,'.$id.',penjualan_id',
            'pembeli' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date',
            'user_id' => 'required|integer'
        ]);

        PenjualanModel::find($id)->update(
            [
                'penjualan_kode' => $request->penjualan_kode,
                'pembeli' => $request->pembeli,
                'penjualan_tanggal' => $request->penjualan_tanggal,
                'user_id' => $request->user_id
            ]
        );

        return redirect('/penjualan')->with('success', 'Data user berhasil di ubah');
    }

    public function destroy(string $id) {

        $check = PenjualanModel::find($id);
        if(!$check) { // untuk mengecek data user dengan id yang dimaksud ada atau tidak
            return redirect('penjualan')->with('erorr', 'Data user tidak ditemukan');
        }

        try {
            PenjualanModel::destroy($id); // hapus data user
            return redirect('penjualan')->with('success', 'Data user berhasil di hapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // jika terjadi erorr ketika menghapus data
            return redirect('penjualan')->with('erorr', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan tabel ini');
        }
    }
}
