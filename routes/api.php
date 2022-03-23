<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::get('getbooklist', [\App\Http\Controllers\API\DataController::class, 'getBookList'])->name('api.getbooklist');


Route::middleware('auth:sanctum')->group( function () {
    Route::get('product', [\App\Http\Controllers\API\DataController::class, 'index'])->name('api.product.index');
    Route::get('getlatestproduct', [\App\Http\Controllers\API\DataController::class, 'getLatestFive'])->name('api.product.getlatest');
    Route::post('tag/add', [\App\Http\Controllers\API\DataController::class, 'saveTag'])->name('api.tag.add');

});
