<?php

use App\Http\Controllers\back\authcontroller;
use App\Http\Controllers\back\dashboardC;
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
Route::get('/login', [authcontroller::class, 'index'])->name('login');
Route::post('/login', [authcontroller::class, 'login'])->name('login.go');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/pembayaranSpp/admin', [dashboardC::class, 'admin'])->name('admin.index')->middleware('userakses:admin');
    Route::get('/pembayaranSpp/petugas', [dashboardC::class, 'petugas'])->name('petugas.index')->middleware('userakses:petugas');
    Route::get('/pembayaranSpp/user', [dashboardC::class, 'user'])->name('user.index')->middleware('userakses:user');
    Route::get('/logout', [authcontroller::class, 'logout'])->name('logout');

});

Route::get('/pembayaranSpp', function () {
    $user = auth()->user();
    if ($user->level == 'admin') {
        return Redirect::route('admin.index');
    } elseif ($user->level == 'petugas') {
        return Redirect::route('petugas.index');
    } elseif ($user->level == 'user') {
        return Redirect::route('user.index');
    } else {
        return Redirect::route('login');
    }
})->name('redirect.dashboard');


