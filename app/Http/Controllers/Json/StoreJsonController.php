<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;

class StoreJsonController extends Controller
{
    public function userStore()
    {
        $store = auth()->user()->store()->with('user')->first();
        return response()->json(['store' => $store]);
    }

    public function storeProducts()
    {   
        $store = auth()->user()->store()->with('user')->first();
        $products = $store->products()->orderBy('created_at','ASC')
                                      ->where('status', 'active')
                                      ->paginate(10);
        return response()->json(['products' => $products]);
    }

    public function storeProductArchives()
    {
        $store = auth()->user()->store()->with('user')->first();
        $products = $store->products()->orderBy('created_at','ASC')
                                      ->where('status', 'archived')
                                      ->paginate(10);
        return response()->json(['products' => $products]);
    }

    public function stores()
    {
        $stores = Store::orderBy('created_at','DESC')->where('status','active')->paginate(6);
        return response()->json(['stores' => $stores]);
    }

    public function searchStoreProducts($data)
    {
        $store = auth()->user()->store()->with('user')->first();
        $products = $store->products()->where('name','like','%'.$data.'%')
                                      ->orWhere('code', $data)   
                                      ->paginate(20);
        return response()->json(['products' => $products]);
    }


    public function findStore($id)
    {
        $store = Store::findOrFail($id);
        $following = false;
        if(auth()->user()->alreadyFollowedStore($store->id)) {
            $following = true;
        }
        return response()->json([
            'store' => $store,
            'products' => $store->products()->get(),
            'followers' => $store->follows()->get(),
            'following' => $following
        ]);
    }

    public function viewStoreProducts($id)
    {
        $store = Store::findOrFail($id);
        $products = $store->products()->with('images')->orderBy('created_at', 'DESC')->paginate(4);
        return response()->json(['products' => $products]);
    }

    public function storeOrders()
    {
        $store = auth()->user()->store()->first();
        $orders = $store->orders()->with('product.images')->paginate(5);
        return response()->json(['orders' => $orders]);
    }

    public function adminStoreList()
    {
        $stores = Store::orderBy('name', 'ASC')->with('user')->with('products')->paginate(10);
        return response()->json(['stores' => $stores]);
    }

    public function adminStoreRequests()
    {
        $stores = Store::orderBy('name', 'ASC')->where('status', 'pending')
                                               ->with('user')
                                               ->with('products')
                                               ->paginate(10);
        return response()->json(['stores' => $stores]);
    }

    public function adminStoreOwners()
    {
        $stores = Store::orderBy('name', 'ASC')->with('user')->paginate(10);
        return response()->json(['stores' => $stores]);
    }

    public function adminStoreArchive()
    {
        $stores = Store::orderBy('name', 'ASC')->where('status', 'archived')->paginate(10);
        return response()->json(['stores' => $stores]);
    }

}
