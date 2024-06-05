<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JeroenNoten\LaravelAdminLte\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index() {
        // ambil data user
        $user = Auth::user();

        // Jika user ada
        if($user) {
            // jika user memiliki level admin
            if($user->level_id == '1') {
                return redirect()->intended('admin');
            }
            // jika user memiliki level manager
            elseif($user->level_id == '2') {
                return redirect()->intended('manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request) {
        // validasi data
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // ambil data request username & password saja
        $credential = $request->only('username', 'password');
        
        // cek jika data username dan password valid
        if(Auth::attempt($credential)) {

            // jika validasi berhasil, simpan data user
            $user = Auth::user();

            // jika user memiliki level admin
            if($user->level_id == '1') {
                return redirect()->intended('admin');
            }
            // jika user memiliki level manager
            elseif($user->level_id == '2') {
                return redirect()->intended('manager');
            }
            return  redirect()->intended('/');
        }
        // jika validasi gagal, tampilkan pesan erorrnya
        return redirect('login')
        ->withInput()
        ->withErrors(['login_gagal'=> 'Pastikan kembali username dan password yang dimasukkan sudah benar']);
    }

    public function register() {
        // tampilkan view register
        return view('register');
    }

    // aksi form register
    public function proses_register(Request $request) {
        // validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:m_user',
            'password' => 'required'
        ]);

        // jika validasi gagal, arahkan ke halaman register dan tampilkan pesan errornya
        if($validator->fails()) {
            return redirect('/register')
            ->withErrors($validator)
            ->withInput();
        }

        // jika validasi berhasil, isi level secara default & hash passwordnya
        $request['level_id'] = '2';
        $request['password'] = Hash::make($request->password);

        // masukkan semua data pada request ke table user
        UserModel::create($request->all());

        // kalo berhasil arahkan ke halaman login
        return redirect()->route('login');
    }

    public function logout(Request $request) {
        // logout itu harus menghapus sessionnya
        $request->session()->flush();

        // jalankan fungsi logout pada auth
        Auth::logout();
        // kembali ke halaman login
        return redirect('login');
    }
}
