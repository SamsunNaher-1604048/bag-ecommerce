<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\SiteController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CheckoutController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/','home')->name('home');
    Route::get('/shop','shop')->name('shop');
    Route::get('/about','about')->name('about');
    Route::get('/services','services')->name('services');
    Route::get('/blog','blog')->name('blog');
    Route::get('/contact','contact')->name('contact');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login','loginPage')->name('login.page');
    Route::post('/login','login')->name('login');
    Route::post('/logout','logout')->name('logout');
});

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/register','registerPage')->name('register.page');
    Route::post('/register','register')->name('register');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart','cart')->name('cart');
    Route::get('/cart/add','cartAdd')->name('cart.add');
    Route::get('/cart/count','cartProductCount')->name('cart.count');
    Route::get('/cart/remove','cartRemove')->name('cart.remove');
    Route::get('/cart/update','cartUpdate')->name('cart.update');
    Route::get('/cart/calculate','cartCalculate')->name('cart.calculate');
});

Route::controller(WishlistController::class)->group(function () {
    Route::get('/wishlist','showWishlist')->name('wishlist');
    Route::get('/wishlist/add','wishlistAdd')->name('wishlist.add');
    Route::get('/wishlist/remove','wishlistRemove')->name('wishlist.remove');
});

Route::controller(SiteController::class)->group(function () {
    Route::get('product/details/{id}','productDetails')->name('product.details');
});

Route::controller(CheckoutController::class)->prefix('/checkout')->name('checkout')->group(function () {
    Route::get('/','checkoutPage');
});

Route::middleware(['redirectIfUser'])->group(function () {
    Route::controller(UserController::class)->prefix('/user')->name('user.')->group(function () {
        Route::get('/dashboard','dashboard')->name('dashboard');
        Route::get('/profile/edit','profileEdit')->name('profile.edit');
        Route::post('/profile/update/{id}','profileUpdate')->name('profile.update');
        Route::get('/orders','orders')->name('orders');
    });
});


