<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absenController;
use App\Http\Controllers\LiveSearchController;
use App\Http\Controllers\LiveSearchMuridController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\AbsensiMuridController;
use App\Http\Controllers\kompetensiController;
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
    
// LIVE SEARCH GURU
Route::get('/liveSearch', [App\Http\Controllers\LiveSearchController::class, 'liveSearch'])->name('liveSearch');
Route::get('/hasil', [App\Http\Controllers\LiveSearchController::class, 'hasil'])->name('hasil');
Route::get('/action', [App\Http\Controllers\LiveSearchController::class, 'action'])->name('action');

// LIVE SEARCH MURID
Route::get('/liveSearchMurid', [App\Http\Controllers\LiveSearchMuridController::class, 'liveSearch'])->name('liveSearchMurid');
Route::get('/hasil/murid', [App\Http\Controllers\LiveSearchMuridController::class, 'hasil'])->name('hasilMurid');
Route::get('/action/murid', [App\Http\Controllers\LiveSearchMuridController::class, 'action'])->name('actionMurid');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('/absensi/guru', AbsensiGuruController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/kompetensi', [kompetensiController::class, 'index'])->name('kompetensi.index')->middleware('can:view-kompetensi');
    Route::post('/kompetensi', [kompetensiController::class, 'store'])->name('kompetensi.store')->middleware('can:create-kompetensi');
    Route::get('/kompetensi/create', [kompetensiController::class, 'create'])->name('kompetensi.create')->middleware('can:create-kompetensi');
    Route::get('/kompetensi/{kompetensi}', [kompetensiController::class, 'show'])->name('kompetensi.show')->middleware('can:view-kompetensi');
    Route::put('/kompetensi/{kompetensi}', [kompetensiController::class, 'update'])->name('kompetensi.update')->middleware('can:edit-kompetensi');
    Route::delete('/kompetensi/{kompetensi}', [kompetensiController::class, 'destroy'])->name('kompetensi.destroy')->middleware('can:delete-kompetensi');
    Route::get('/kompetensi/{kompetensi}/edit', [kompetensiController::class, 'edit'])->name('kompetensi.edit')->middleware('can:edit-kompetensi');

    Route::get('/absensi/guru', [AbsensiGuruController::class, 'index'])->name('guru.index');
    Route::post('/absensi/guru/store', [AbsensiGuruController::class, 'store'])->name('guru.store');
    Route::get('/absensi/guru/create', [AbsensiGuruController::class, 'create'])->name('guru.create');
    Route::put('/absensi/guru/update', [AbsensiGuruController::class, 'update'])->name('guru.update');
    Route::get('/absensi/guru/edit/', [AbsensiGuruController::class, 'edit'])->name('guru.edit');

    Route::get('/absensi/murid', [AbsensiMuridController::class, 'index'])->name('murid.index');
    Route::post('/absensi/murid/store', [AbsensiMuridController::class, 'store'])->name('murid.store');
    Route::get('/absensi/murid/create', [AbsensiMuridController::class, 'create'])->name('murid.create');
    Route::put('/absensi/murid/update', [AbsensiMuridController::class, 'update'])->name('murid.update');
    Route::get('/absensi/murid/edit/', [AbsensiMuridController::class, 'edit'])->name('murid.edit');


});

