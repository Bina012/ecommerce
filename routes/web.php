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
Route::post('/category/filter_product', [\App\Http\Controllers\Frontend\FrontendController::class, 'filterProduct'])->name('frontend.category.filter_product');
Route::get('/', [\App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('frontend.index');
Route::get('/category/{slug}', [\App\Http\Controllers\Frontend\FrontendController::class, 'category'])->name('frontend.category');
Route::get('/subcategory/{slug}', [\App\Http\Controllers\Frontend\FrontendController::class, 'subcategory'])->name('frontend.subcategory');
Route::get('/product/{slug}', [\App\Http\Controllers\Frontend\FrontendController::class, 'product'])->name('frontend.product');
Route::post('/cart/add', [\App\Http\Controllers\Frontend\CartController::class, 'add'])->name('frontend.cart.add');
Route::get('/cart', [\App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [\App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');
Route::get('/cart/checkout', [\App\Http\Controllers\Frontend\CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/apply_coupon', [\App\Http\Controllers\Frontend\CartController::class, 'applyCoupon'])->name('cart.apply_coupon');
Route::post('/cart/make_order', [\App\Http\Controllers\Frontend\CartController::class, 'makeOrder'])->name('frontend.cart.make_order');


Auth::routes(['register' => true]);
Route::middleware(['auth','permission'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::post('/category/getsubcategory', [\App\Http\Controllers\Backend\CategoryController::class, 'getSubcategory'])->name('category.getsubcategory');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('backend')->name('backend.')->middleware(['auth','permission'])->group(function(){
    Route::get('/role/assign_form/{id}', [\App\Http\Controllers\Backend\RoleController::class, 'assignForm'])->name('role.assign_form');
    Route::post('/role/assign_permission', [\App\Http\Controllers\Backend\RoleController::class, 'assignPermission'])->name('role.assign_permission');
    Route::resource('/category', \App\Http\Controllers\Backend\CategoryController::class );
    Route::resource('/subcategory',\App\Http\Controllers\Backend\SubCategoryController::class);
    Route::resource('/product',\App\Http\Controllers\Backend\ProductController::class);
    Route::resource('/unit',\App\Http\Controllers\Backend\UnitController::class);
    Route::resource('/tag', \App\Http\Controllers\Backend\TagController::class );
    Route::resource('/attribute',\App\Http\Controllers\Backend\AttributeController::class);
    Route::resource('/module',\App\Http\Controllers\Backend\ModuleController::class);
    Route::resource('/permission',\App\Http\Controllers\Backend\PermissionController::class);
    Route::resource('/role',\App\Http\Controllers\Backend\RoleController::class);
    Route::resource('/user',\App\Http\Controllers\Backend\UserController::class);
    Route::resource('/setting',\App\Http\Controllers\Backend\SettingController::class);
    Route::resource('/coupon',\App\Http\Controllers\Backend\CouponController::class);
    Route::resource('/rating',\App\Http\Controllers\Backend\RatingController::class);
});
