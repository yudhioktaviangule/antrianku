<?php

use App\Http\Controllers\ErrCont;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\RegisterAntrian;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('register_antrian',RegisterAntrian::class);
Route::resource('loket',LoketController::class);
Route::resource('user',UserController::class);
Route::get('nauthorize',[ErrCont::class,'not_authorize']);