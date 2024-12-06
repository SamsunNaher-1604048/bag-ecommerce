<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\ShippingController;


Route::controller(LoginController::class)->group(function () {
    Route::get('/','adminLoginPage')->name('login.page');
    Route::post('/login','adminLogin')->name('login');
    Route::post('/logout','adminLogout')->name('logout');
});


Route::middleware(['redirectIfAdmin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard','dashboard')->name('dashboard');
    });

    Route::controller(UsersController::class)->prefix('/users')->name('users.')->group(function () {
        Route::get('/list','index')->name('list');
        Route::get('/active','active')->name('active');
        Route::get('/inactive','inactive')->name('inactive');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}','update')->name('update');
    });

    Route::controller(CategoryController::class)->prefix('/categories')->name('categories.')->group(function () {
        Route::get('/list','index')->name('list');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}','update')->name('update');
    });

    Route::controller(ColorController::class)->prefix('/colors')->name('colors.')->group(function () {
        Route::get('/list','index')->name('list');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}','update')->name('update');
    });

    Route::controller(BrandController::class)->prefix('/brands')->name('brands.')->group(function () {
        Route::get('/list','index')->name('list');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}','update')->name('update');
    });

    Route::controller(SupplierController::class)->prefix('/suppliers')->name('suppliers.')->group(function () {
        Route::get('/list','index')->name('list');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}','update')->name('update');
    });

    Route::controller(ShippingController::class)->prefix('/shipping')->name('shipping.')->group(function () {
        Route::get('/list','index')->name('list');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}','update')->name('update');
    });

    Route::controller(ProductController::class)->prefix('/products')->name('products.')->group(function () {
        Route::get('/list','index')->name('list');
        Route::get('/active','active')->name('active');
        Route::get('/inactive','inActive')->name('inactive');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}','update')->name('update');
    });
});
