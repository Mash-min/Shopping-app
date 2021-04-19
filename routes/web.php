<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Json\StoreJsonController;
use App\Http\Controllers\Json\ProductJsonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FollowedStoreController;
use App\Http\Controllers\SavedProductControler;
use App\Http\Controllers\OrderController;

Route::get('/',                              [PagesController::class,       'index'])->name('index');
Route::get('/stores',                        [PagesController::class,      'stores'])->name('stores');
Route::get('/products',                      [PagesController::class,    'products'])->name('products');
Route::get('/stores/view/id={id}',           [PagesController::class,   'viewStore'])->middleware('auth');
Route::get('/products/view/{code}',          [PagesController::class, 'viewProduct'])->middleware('auth');

Require __DIR__.'/user.php';
Require __DIR__.'/admin.php';

Route::group(['prefix' => '/store/api'], function() {
    Route::get('/stores/json',                    [StoreJsonController::class, 'stores']);
    Route::get('/stores/view/products/json/{id}', [StoreJsonController::class, 'viewStoreProducts']);
    Route::get('/find/id={id}',                   [StoreJsonController::class, 'findStore']);
    Route::group(['middleware' => 'auth'], function() {
        Route::post('/create',             [StoreController::class, 'create']);
        Route::post('/delete/id={id}',     [StoreController::class, 'delete']);
        Route::post('/update/id={id}',     [StoreController::class, 'update']);
        Route::post('/update/my_store',    [StoreController::class, 'updateMyStore']);
        Route::post('/update/store_image', [StoreController::class, 'updateStoreImage']);
    });
});

Route::group(['prefix' => 'product/api'], function() {
    Route::get('/products/json',               [ProductJsonController::class, 'products']);
    Route::get('/search/{data}',               [ProductJsonController::class, 'searchProduct']);
    Route::get('/find/id={id}',                [ProductJsonController::class, 'find']);
    Route::get('/find/{code}',                 [ProductJsonController::class, 'findProductCode']);
    Route::get('/find/{code}/reviews/json',   [ProductJsonController::class,  'productReviews']);

    Route::group(['middleware' => 'auth'], function() {
        Route::post('/create',                 [ProductController::class, 'create']);
        Route::post('/delete/id={id}',         [ProductController::class, 'delete']);
        Route::post('/update/id={id}',         [ProductController::class, 'update']);
        Route::post('/archive/id={id}',        [ProductController::class, 'archive']);
        Route::post('/remove_archive/id={id}', [ProductController::class, 'removeArchive']);
    });
});

Route::group(['prefix' => 'tags/api', 'middleware' => 'auth'], function() {
    Route::post('/create', [TagsController::class, 'create']);
});

Route::group(['prefix' => 'review/api'], function() {
    Route::get('/find/id={id}',    [ReviewController::class,   'find']);
    Route::post('/create',         [ReviewController::class, 'create']);
    Route::post('/update/id={id}', [ReviewController::class, 'update']);
    Route::delete('/delete/id={id}', [ReviewController::class, 'delete']);
});

Route::group(['prefix' => 'cart/api', 'middleware' => 'auth'], function() {
    Route::get('/json',              [CartController::class, 'myCart']);
    Route::post('/create',           [CartController::class, 'create']);
    Route::delete('/delete/id={id}', [CartController::class, 'delete']);
});

Route::group(['prefix' => 'followed_store/api', 'middleware' => 'auth'], function() {
    Route::post('/create', [FollowedStoreController::class, 'create']);
    Route::delete('/delete/id={id}', [FollowedStoreController::class, 'delete']);
    Route::get('/stores/json', [FollowedStoreController::class, 'userFollowedStores']);
}); 

Route::group(['prefix' => 'saved_product/api', 'middleware' => 'auth'], function() {
    Route::post('/create', [SavedProductControler::class, 'create']);
    Route::delete('/delete/id={id}', [SavedProductControler::class, 'delete']);
    Route::get('/products/json', [SavedProductControler::class, 'userSavedProducts']);
});

Route::group(['prefix' => 'order/api', 'middleware' => 'auth'], function() {
    Route::post('/create',           [OrderController::class, 'create']);
    Route::delete('/delete/id={id}', [OrderController::class, 'delete']);
    Route::get('/find/id={id}',      [OrderController::class, 'find']);
    Route::get('/json',              [OrderController::class, 'myOrders']);
});