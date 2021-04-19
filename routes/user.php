<?php
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Json\StoreJsonController;

Route::group(['prefix' => '/user'], function() {
    Route::post('/register',       [RegisterController::class, 'create'])->name('register');
    Route::post('/login',          [LoginController::class,    'create'])->name('login');
    Route::post('/logout',         [LoginController::class,   'destroy'])->name('logout');

    Route::group(['middleware' => 'auth'], function() {
        Route::post('/update',               [RegisterController::class, 'update']);
        Route::post('/check_password',       [RegisterController::class, 'checkPassword']);
        Route::post('/reset_password',       [RegisterController::class, 'resetPassword']);
        Route::get('/profile',               [PagesController::class,        'profile'])->name('profile');
        Route::get('/settings' ,             [PagesController::class,       'settings'])->name('settings');
        Route::get('/notifications',         [PagesController::class,  'notifications'])->name('notifications');
        Route::get('/my_cart',               [PagesController::class,         'myCart'])->name('my_cart');
        Route::get('/my_orders',             [PagesController::class,       'myOrders'])->name('my_orders');
        Route::get('/my_store',              [PagesController::class,        'myStore'])->name('my_store');
        Route::get('/my_store/add_products', [PagesController::class,    'addProducts'])->name('add_products');
        Route::get('/my_store/archives',     [PagesController::class,       'archives'])->name('archives');
        Route::get('/store_orders',          [PagesController::class,    'storeOrders'])->name('store_order');
        Route::get('/saved_products',        [PagesController::class,  'savedProducts'])->name('saved_products');
        Route::get('/followed_stores',       [PagesController::class, 'followedStores'])->name('followed_stores');
    });
    Route::group(['prefix' => '/api'], function() {
        Route::get('/store/json',                   [StoreJsonController::class, 'userStore']);
        Route::get('/store/products/json',          [StoreJsonController::class, 'storeProducts']);
        Route::get('/store/products/search/{data}', [StoreJsonController::class, 'searchStoreProducts']);
        Route::get('/store/products/archives/json', [StoreJsonController::class, 'storeProductArchives']);
        Route::get('/store/products/orders/json',   [StoreJsonController::class, 'storeOrders']);
    });
});