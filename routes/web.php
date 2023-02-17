<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'level:masyarakat'])->group(function () {
Route::resource('pengaduan', PengaduanController::class);
});

Route::get('login', [LoginController::class, 'view'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses')->middleware('guest');

// Route::get('dashboard/admin', [Dashboard::class, 'admin'])->name('dashboard.admin')->middleware('auth');
// Route::middleware(['auth', 'level:masyarakat'])->group(function (){
Route::get('dashboard/admin', [Dashboard::class, 'admin'])->name('dashboard.admin')->middleware('auth');
Route::get('/dashboard/petugas', [Dashboard::class, 'petugas'])->name('dashboard.petugas')->middleware('auth');
Route::get('/dashboard/masyarakat', [Dashboard::class, 'masyarakat'])->name('dashboard.masyarakat')->middleware('auth');
// });


Route::get('logout', [LoginController::class, 'logout'])->name('logout-petugas');

Route::get('register', [RegisterController::class, 'view'])->name('register')->middleware(('guest'));
Route::post('register', [RegisterController::class, 'store'])->name('register.store')->middleware(( 'guest'));

Route::view('error/403', 'error.403' )->name('error.403');



