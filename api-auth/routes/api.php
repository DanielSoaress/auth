<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Models\Address;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:api')->get('/address', function (Request $request) {
    return Address::where('user_id', auth()->user()->id)->first();
});
Route::resource('user', UserController::class)->only([
    'index', 'show', 'store', 'destroy'])->middleware('auth:api');
Route::post('user/update/{id}', [UserController::class, 'update'])->middleware('auth:api');

Route::post('login', [LoginController::class, 'authenticate']);
 