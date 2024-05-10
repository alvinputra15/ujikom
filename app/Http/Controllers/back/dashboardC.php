<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardC extends Controller
{
    public function index(){
    return view('admin.index');
    }
    public function petugas(){
        return view('petugas.index');
        }
    public function user(){
            return view('user.index');
            }
}
