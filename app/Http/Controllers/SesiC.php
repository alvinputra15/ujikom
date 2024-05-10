<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiC extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $req){
        $req->validate([
            'email' =>'required',
            'password' => 'required'
        ],
    [
        'email.required' => 'email wajib di isi',
        'password.required' => 'password wajib disii'
    ]);
    $infologin = [
        'email'   => $req->email,
        'password' => $req->password
    ];
    if (Auth::attempt($infologin)) {
        if (Auth::user()->level == 'admin') {
            return redirect('admin');
        }elseif(Auth::user()->level == 'petugas') {
                return redirect('petugas');
        }elseif(Auth::user()->level == 'user') {
                return redirect('user');
        }
    }else{
        return redirect('')->withErrors('kontol ')->withInput();
    }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
