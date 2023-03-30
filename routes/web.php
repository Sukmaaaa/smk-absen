<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absenController;
use App\Http\Controllers\LiveSearchController;
use App\Http\Controllers\LiveSearchMuridController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\AbsensiMuridController;
use App\Http\Controllers\kompetensiController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\muridController;
use App\Http\Controllers\jurusanController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\roleController;
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
    // PERMISSION
    Route::get('/permission', [permissionController::class, 'index'])->name('permission.index')->middleware('can:view-permission');
    Route::post('/permission', [permissionController::class, 'store'])->name('permission.store')->middleware('can:create-permission');
    Route::get('/permission/create', [permissionController::class, 'create'])->name('permission.create')->middleware('can:create-permission');
    Route::get('/permission/{permission}', [permissionController::class, 'show'])->name('permission.show')->middleware('can:view-permission');
    Route::put('/permission/{permission}', [permissionController::class, 'update'])->name('permission.update')->middleware('can:edit-permission');
    Route::delete('/permission/{permission}', [permissionController::class, 'destroy'])->name('permission.destroy')->middleware('can:delete-permission');
    Route::get('/permission/{permission}/edit', [permissionController::class, 'edit'])->name('permission.edit')->middleware('can:edit-permission');
    // ROLE
    Route::get('/role', [roleController::class, 'index'])->name('role.index')->middleware('can:view-role');
    Route::post('/role', [roleController::class, 'store'])->name('role.store')->middleware('can:create-role');
    Route::get('/role/create', [roleController::class, 'create'])->name('role.create')->middleware('can:create-role');
    Route::get('/role/{role}', [roleController::class, 'show'])->name('role.show')->middleware('can:view-role');
    Route::put('/role/{role}', [roleController::class, 'update'])->name('role.update')->middleware('can:edit-role');
    Route::delete('/role/{role}', [roleController::class, 'destroy'])->name('role.destroy')->middleware('can:delete-role');
    Route::get('/role/{role}/edit', [roleController::class, 'edit'])->name('role.edit')->middleware('can:edit-role');
    // KOMPETENSI
    Route::get('/kompetensi', [kompetensiController::class, 'index'])->name('kompetensi.index')->middleware('can:view-kompetensi');
    Route::post('/kompetensi', [kompetensiController::class, 'store'])->name('kompetensi.store')->middleware('can:create-kompetensi');
    Route::get('/kompetensi/create', [kompetensiController::class, 'create'])->name('kompetensi.create')->middleware('can:create-kompetensi');
    Route::get('/kompetensi/{kompetensi}', [kompetensiController::class, 'show'])->name('kompetensi.show')->middleware('can:view-kompetensi');
    Route::put('/kompetensi/{kompetensi}', [kompetensiController::class, 'update'])->name('kompetensi.update')->middleware('can:edit-kompetensi');
    Route::delete('/kompetensi/{kompetensi}', [kompetensiController::class, 'destroy'])->name('kompetensi.destroy')->middleware('can:delete-kompetensi');
    Route::get('/kompetensi/{kompetensi}/edit', [kompetensiController::class, 'edit'])->name('kompetensi.edit')->middleware('can:edit-kompetensi');
    // JURUSAN
    Route::get('/jurusan', [jurusanController::class, 'index'])->name('jurusan.index')->middleware('can:view-jurusan');
    Route::post('/jurusan', [jurusanController::class, 'store'])->name('jurusan.store')->middleware('can:create-jurusan');
    Route::get('/jurusan/create', [jurusanController::class, 'create'])->name('jurusan.create')->middleware('can:create-jurusan');
    Route::get('/jurusan/{jurusan}', [jurusanController::class, 'show'])->name('jurusan.show')->middleware('can:view-jurusan');
    Route::put('/jurusan/{jurusan}', [jurusanController::class, 'update'])->name('jurusan.update')->middleware('can:edit-jurusan');
    Route::delete('/jurusan/{jurusan}', [jurusanController::class, 'destroy'])->name('jurusan.destroy')->middleware('can:delete-jurusan');
    Route::get('/jurusan/{jurusan}/edit', [jurusanController::class, 'edit'])->name('jurusan.edit')->middleware('can:edit-jurusan');
    // MANAGEMENT GURU
    Route::get('/management/guru', [guruController::class, 'index'])->name('management.guru.index')->middleware('can:view-user');
    Route::post('/management/guru', [guruController::class, 'store'])->name('management.guru.store')->middleware('can:create-user');
    Route::get('/management/guru/create', [guruController::class, 'create'])->name('management.guru.create')->middleware('can:create-user');
    Route::get('/management/guru/{guru}', [guruController::class, 'show'])->name('management.guru.show')->middleware('can:view-user');
    Route::put('/management/guru/{guru}', [guruController::class, 'update'])->name('management.guru.update')->middleware('can:edit-user');
    Route::delete('/management/guru/{guru}', [guruController::class, 'destroy'])->name('management.guru.destroy')->middleware('can:delete-user');
    Route::get('/management/guru/{guru}/edit', [guruController::class, 'edit'])->name('management.guru.edit')->middleware('can:edit-user');
    // MANAGEMENT MURID
    Route::get('/management/murid', [muridController::class, 'index'])->name('management.murid.index')->middleware('can:view-murid');
    Route::post('/management/murid', [muridController::class, 'store'])->name('management.murid.store')->middleware('can:create-murid');
    Route::get('/management/murid/create', [muridController::class, 'create'])->name('management.murid.create')->middleware('can:create-murid');
    Route::get('/management/murid/{murid}', [muridController::class, 'show'])->name('management.murid.show')->middleware('can:view-murid');
    Route::put('/management/murid/{murid}', [muridController::class, 'update'])->name('management.murid.update')->middleware('can:edit-murid');
    Route::delete('/management/murid/{murid}', [muridController::class, 'destroy'])->name('management.murid.destroy')->middleware('can:delete-murid');
    Route::get('/management/murid/{murid}/edit', [muridController::class, 'edit'])->name('management.murid.edit')->middleware('can:edit-murid');
    // ABSENSI GURU
    Route::get('/absensi/guru', [AbsensiGuruController::class, 'index'])->name('guru.index');
    Route::post('/absensi/guru/store', [AbsensiGuruController::class, 'store'])->name('guru.store');
    Route::get('/absensi/guru/create', [AbsensiGuruController::class, 'create'])->name('guru.create');
    Route::put('/absensi/guru/update', [AbsensiGuruController::class, 'update'])->name('guru.update');
    Route::get('/absensi/guru/edit/', [AbsensiGuruController::class, 'edit'])->name('guru.edit');
    // ABSENSI MURID
    Route::get('/absensi/murid', [AbsensiMuridController::class, 'index'])->name('murid.index');
    Route::post('/absensi/murid/store', [AbsensiMuridController::class, 'store'])->name('murid.store');
    Route::get('/absensi/murid/create', [AbsensiMuridController::class, 'create'])->name('murid.create');
    Route::put('/absensi/murid/update', [AbsensiMuridController::class, 'update'])->name('murid.update');
    Route::get('/absensi/murid/edit/', [AbsensiMuridController::class, 'edit'])->name('murid.edit');


});

