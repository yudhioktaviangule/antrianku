<?php

use App\Http\Controllers\Api\AntrianApi;
use App\Http\Controllers\Api\AntrianViewApi;
use App\Http\Controllers\Api\SesiLoginAPI;
use App\Http\Controllers\Api\SubscribeToken;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('fcm',SubscribeToken::class);
Route::resource('antriapi',AntrianApi::class);
Route::resource('antriviewapi',AntrianViewApi::class);
Route::get('ceksesi/{id?}',[SesiLoginAPI::class,'sesi']);
Route::get('setsesi/{user_id?}/{loket_id?}',[SesiLoginAPI::class,'pilihLoket']);