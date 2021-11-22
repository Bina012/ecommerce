<?php

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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/category/getsubcategory', [\App\Http\Controllers\Backend\CategoryController::class, 'getSubcategory'])->name('category.getsubcategory');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('backend')->name('backend.')->group(function(){
    Route::resource('/category', \App\Http\Controllers\Backend\CategoryController::class );
    Route::resource('/subcategory',\App\Http\Controllers\Backend\SubCategoryController::class);
    Route::resource('/product',\App\Http\Controllers\Backend\ProductController::class);
    Route::resource('/unit',\App\Http\Controllers\Backend\UnitController::class);
    Route::resource('/tag', \App\Http\Controllers\Backend\TagController::class );
    Route::resource('/attribute',\App\Http\Controllers\Backend\AttributeController::class);

});
