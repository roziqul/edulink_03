<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class loginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
      
        if(Auth::attempt($credentials))
        {
            if (auth()->user()->role == 'student') {
                Alert::success('Autentikasi Berhasil');
                return redirect()->route('student.dashboard');
            } elseif (auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin') {
                Alert::success('Autentikasi Berhasil');
                return redirect()->route('admin.dashboard');
            } 
        }
        else{
            Alert::error('Autentikasi Gagal', 'Silahkan periksa kembali email dan password yang anda masukkan!');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        
        return redirect()->route('login');
    }
}
