<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Json\ProductJsonController;
use App\Http\Controllers\Json\StoreJsonController;

Route::group(['prefix' => 'admin', 'middleware' => 'checkAdmin', 'middleware' => 'auth'], function() {
   Route::get('/dashboard',        [AdminPagesController::class, 'dashboard'])->name('dashboard'); 
   Route::get('/product_list',     [AdminPagesController::class, 'productList'])->name('product_list');
   Route::get('/product_requests', [AdminPagesController::class, 'productRequests'])->name('product_requests');
   Route::get('/product_archive',  [AdminPagesController::class, 'productArchive'])->name('product_archive');
   Route::get('/store_list',       [AdminPagesController::class, 'storeList'])->name('store_list');
   Route::get('/store_requests',   [AdminPagesController::class, 'storeRequests'])->name('store_requests');
   Route::get('/store_owners',     [AdminPagesController::class, 'storeOwners'])->name('store_owners');
   Route::get('/store_archive',    [AdminPagesController::class, 'storeArchive'])->name('store_archive');

   Route::group(['prefix' => 'product'], function() {
      Route::get('/list',                    [ProductJsonController::class, 'adminProductList']);
      Route::get('/list/data={data}',        [ProductJsonController::class, 'adminProductListSearch']);
      Route::get('/requests',                [ProductJsonController::class, 'adminProductRequest']);
      Route::get('/requests/data={data}',    [ProductJsonController::class, 'adminProductRequestSearch']);
      Route::get('/archive',                 [ProductJsonController::class, 'adminProductArchive']);
      Route::get('/find/id={id}',            [ProductController::class,     'find']);
      Route::post('/archive/id={id}',        [ProductController::class,     'archive']);
      Route::post('/update/id={id}',         [ProductController::class,     'update']);
      Route::post('/remove_archive/id={id}', [ProductController::class,     'removeArchive']);
      Route::post('/accept/id={id}',         [ProductController::class,     'acceptRequest']);
      Route::delete('/decline/id={id}',      [ProductController::class,     'declineRequest']);
   });

   Route::group(['prefix' => 'store'], function() {
      Route::get('/list', [StoreJsonController::class, 'adminStoreList']);
      Route::get('/requests', [StoreJsonController::class, 'adminStoreRequests']);
      Route::get('/owners', [StoreJsonController::class, 'adminStoreOwners']);
      Route::get('/archive', [StoreJsonController::class, 'adminStoreArchive']);
   });
});

