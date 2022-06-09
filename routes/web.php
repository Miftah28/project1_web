<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermintaanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Pengunjung\PostController;
use App\Http\Controllers\Pengunjung\KontrakController;
use App\Http\Controllers\Pengunjung\ProductCustomerController;
use App\Http\Controllers\MitraController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// --ROUTE PENGUNJUNG--
Route::get('/', [PostController::class, 'index'])->name('pengunjung');
Route::get('/productCustomer', [ProductCustomerController::class, 'index'])->name('product');
Route::get('/postproduk', [ProductCustomerController::class, 'postproduk'])->name('postproduk');
Route::get('/permintaan', [PostController::class, 'permintaan'])->name('permintaan');
Route::get('/kontrakSaya', [KontrakController::class, 'index'])->name('kontrak');
Route::get('/kontrakSaya/download/{requestID}', [KontrakController::class, 'download'])->name('kontrak.download');
Route::get('/kontrakSaya/edit/{requestID}', [KontrakController::class, 'edit'])->name('kontrak.edit');

// --ROUTE PRODUCT--
Route::resource('admin/products', ProductController::class)->middleware('auth');
Route::get('admin/products/{productID}/images', [ProductController::class, 'images'])->name('products.images');
Route::get('admin/products/{productID}/add-image', [ProductController::class, 'add_image'])->name('products.add_image');
Route::post('admin/products/images/{productID}', [ProductController::class, 'upload_image'])->name('products.upload_image');
Route::delete('admin/products/images/{imageID}', [ProductController::class, 'remove_image'])->name('products.remove_image');

// --ROUTE CATEGORIES--
Route::resource('admin/categories', CategoryController::class)->middleware('auth');

// --ROUTE PERMINTAAN--
Route::resource('admin/permintaan', PermintaanController::class)->middleware('auth');
Route::post('/tambah',[PermintaanController::class,'tambah'])->name('tambah');
Route::get('admin/permintaan/download/{requestID}', [PermintaanController::class, 'download'])->name('permintaan.download');

// --ROUTE DASHBOARD--
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// --ROUTE MITRA--
Route::get('/mitra', [MitraController::class, 'index'])->name('mitra')->middleware('auth');
Route::get('/tambahmitra', [MitraController::class, 'tambahmitra'])->name('tambahmitra');
Route::post('/insertdata', [MitraController::class, 'insertdata'])->name('insertdata');
Route::get('/tampilkandata/{id}', [MitraController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}', [MitraController::class, 'updatedata'])->name('updatedata');
Route::get('/delete/{id}', [MitraController::class, 'delete'])->name('delete');

// --ROUTE API--
$router->group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api'], function () use ($router) {

    $router->get('category', ['uses' => 'CategoryController@showAllCategory']);

    $router->get('mainCategory', ['uses' => 'CategoryController@showMainCategory']);

    $router->get('subCategory/{id}', ['uses' => 'CategoryController@showSubCategory']);

    $router->get('productCategory/{id}', ['uses' => 'ProductController@showProductbyCategory']);

    $router->get('product/{id}', ['uses' => 'ProductController@showOneProduct']);

    $router->get('product', ['uses' => 'ProductController@showAllProduct']);

    $router->get('productImage/{id}', ['uses' => 'ProductController@showProductImage']);

    $router->get('contract/{id}', ['uses' => 'ContractController@showContract']);

    $router->get('edit/{id}', ['uses' => 'ContractController@editContract']);

    $router->get('login/{email}&{password}', ['uses' => 'UserController@login']);

    $router->get('customer/{id}', ['uses' => 'UserController@showUser']);

    $router->post('update/{id}', ['uses' => 'UserController@update']);

    $router->post('register', ['uses' => 'UserController@register']);

    $router->post('makeContract', ['uses' => 'UserController@makeContract']);

    $router->get('cek/{idc}&{idp}', ['uses' => 'ContractController@cekKontrak']);
});

