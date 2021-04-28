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
            'email' => 'required|string|email|exists:users',
            'password' => 'required|string'
        ];

        $message = [
            'email.required' => 'Email harus diisi!',
            'email.exists' => 'Email tidak terdaftar!',
            'password.required' => 'Password harus diisi!',
        ];

        $validate = $this->validate($request, $rules, $message);

        if($validate) {
            if(Auth::attempt($request->only('email', 'password'))) {
                return redirect()->route('dashboard')->with('sukses', 'Selamat datang di Sistem Informasi Sarana dan Prasarana');
            } else {
                return redirect()->route('login')->with('gagal', 'Periksa kembali email atau password anda!');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
