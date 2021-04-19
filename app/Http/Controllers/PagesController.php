<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;

class PagesController extends Controller
{

    public function index() 
    {
        return view('pages.index');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function settings()
    {
        return view('user.settings');
    }

    public function notifications()
    {
        return view('user.notifications');
    }

    public function myCart()
    {
        return view('user.my_cart');
    }

    public function myOrders()
    {   
        $orders = auth()->user()->orders()->count();
        return view('user.my_orders', [
            'orders' => $orders
        ]);
    }

    public function myStore()
    {   
        $store = auth()->user()->store()->first();
        if(!auth()->user()->alreadyHaveStore()) {
            return view('redirects.user_no_store');
        }
        return view('user.my_store', [
            'store' => $store
        ]);
    }

    public function storeOrders()
    {
        $store = auth()->user()->store()->first();
        if(!auth()->user()->alreadyHaveStore()) {
            return view('redirects.user_no_store');
        }
        return view('user.store_orders', [
            'store' => $store
        ]);
    }

    public function addProducts()
    {
        if(!auth()->user()->alreadyHaveStore()) {
            return view('redirects.user_no_store');
        }
        return view('user.add_products');
    }

    public function archives()
    {
        if(!auth()->user()->alreadyHaveStore()) {
            return view('redirects.user_no_store');
        }
        return view('user.archives');
    }

    public function savedProducts()
    {
        return view('user.saved_products');
    }

    public function followedStores()
    {
        $stores = auth()->user()->followedStores()->get();
        return view('user.followed_stores', [
            'stores' => $stores
        ]);
    }

    public function stores()
    {
        return view('pages.stores');
    }

    public function viewStore($id) 
    {
        $store = Store::findOrFail($id);
        return view('pages.view_store', ['store' => $store]);
    }

    public function products()
    {
        return view('pages.products');
    }

    public function viewProduct($code) 
    {
        $product = Product::where('code', $code)->first();
        if($product->status == 'active') {
            return view('pages.view_product', ['product' => $product]);
        }else {
            abort(404);
        }
    }

}
