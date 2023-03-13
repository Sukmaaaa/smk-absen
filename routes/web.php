<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absenController;
use App\Http\Controllers\LiveSearchController;
use App\Http\Controllers\AbsensiGuruController;
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

Auth::routes();

Route::get('/index', [App\Http\Controllers\absenController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
// LIVE SEARCH
Route::get('/liveSearch', [App\Http\Controllers\LiveSearchController::class, 'liveSearch'])->name('liveSearch');
Route::get('/hasil', [App\Http\Controllers\LiveSearchController::class, 'hasil'])->name('hasil');
Route::get('/action', [App\Http\Controllers\LiveSearchController::class, 'action'])->name('action');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::post('/absen-guru/hadir', 'AbsensiGuruController@absenHadir')->middleware('auth');
// Route::post('/absen-guru/pulang', 'AbsensiGuruController@absenPulang')->middleware('auth');

// // ABSENSI GURU
// Route::get('/absensi/guru', [AbsensiGuruController::class, 'index'])->middleware('auth');
// Route::get('/absensi/guru/create', [AbsensiGuruController::class, 'create'])->middleware('auth');
// Route::post('/absensi/guru', [AbsensiGuruController::class, 'store'])->middleware('auth');
// Route::get('/absensi/guru/{absensi}', [AbsensiGuruController::class, 'store'])->middleware('auth');


// Route::resource('/absensi/guru', AbsensiGuruController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/absensi/guru', [AbsensiGuruController::class, 'index'])->name('guru.index');
    Route::post('/absensi/guru/store', [AbsensiGuruController::class, 'store'])->name('guru.store');
    Route::get('/absensi/guru/create', [AbsensiGuruController::class, 'create'])->name('guru.create');
    Route::put('/absensi/guru/update', [AbsensiGuruController::class, 'update'])->name('guru.update');
    Route::get('/absensi/guru/edit/', [AbsensiGuruController::class, 'edit'])->name('guru.edit');
});

