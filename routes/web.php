<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absenController;
use App\Http\Controllers\LiveSearchController;
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
