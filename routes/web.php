<?php


use App\Http\Controllers\authcontroller;
use App\Http\Controllers\back\dashboardC;
use App\Http\Controllers\SesiC;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::middleware(['guest'])->group(function(){
Route::get('/login', [SesiC::class, 'index']);
Route::post('/login', [SesiC::class, 'login']);
});

    Route::get('/admin', [dashboardC::class, 'index'])->name('admin.index');
    Route::get('/petugas', [dashboardC::class, 'petugas'])->name('petugas.index');
    Route::get('/user', [dashboardC::class, 'user'])->name('user.index');
    Route::get('/logout', [SesiC::class, 'logout'])->name('logout');

    Route::get('/dashboard/pembayaranSpp', function () {
        if (Auth::check()) {
            if (Auth::user()->level == 'admin') {
                return Redirect::route('admin.index');
            } elseif (Auth::user()->level == 'petugas') {
                return Redirect::route('petugas.index');
            } elseif (Auth::user()->level == 'user') {
                return Redirect::route('user.index');
            }
        }
        return Redirect::route('login');
    })->name('redirect.dashboard');


