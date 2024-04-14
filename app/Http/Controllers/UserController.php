<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }

    public function tambah() {
        return view('user_tambah');
    }

    public function tambah_simpan(UserRequest $request) {
        $validated = $request->validated();

        $validated = $request->safe();
        return redirect('/user');
    }

    public function ubah($id) {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request) {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->username');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id) {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }

    public function form() {
        return view('form.user_form');
    }
}
