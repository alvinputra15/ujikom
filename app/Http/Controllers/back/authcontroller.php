<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authcontroller extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            $user = Auth::user();
            // Periksa level pengguna dan arahkan sesuai dengan level
            if ($user->level === 'admin') {
                return redirect()->route('admin.index');

            } elseif ($user->level === 'petugas') {
                return redirect()->route('petugas.index');
            } elseif ($user->level === 'user') {
                return redirect()->route('user.index');
            }
        }else{
            return redirect('')->withErrors('Username dan password yang di masukan tidak sesuai')->withInput();

        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
