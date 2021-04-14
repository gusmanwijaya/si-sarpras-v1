<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::user() != null){
            return back();
        } else {
            return view('auth.login');
        }
    }

    public function storeLogin(Request $request)
    {
        $rules = [
            'username' => 'required|string|exists:users',
            'password' => 'required|string'
        ];

        $message = [
            'username.required' => 'Username harus diisi!',
            'username.exists' => 'Username tidak terdaftar!',
            'password.required' => 'Password harus diisi!',
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate) {
            if(Auth::attempt($request->only('username', 'password'))) {
                return redirect()->route('dashboard')->with('sukses', 'Selamat datang di Sistem Informasi Sarana dan Prasarana');
            } else {
                return redirect()->route('login')->with('gagal', 'Periksa kembali username atau password anda!');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
