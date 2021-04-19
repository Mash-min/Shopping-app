<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\FollowedStore;

class FollowedStoreController extends Controller
{
    public function create(Request $request) 
    {   
        if(!auth()->user()->alreadyFollowedStore($request->store_id))
        {
            $followedStore = auth()->user()->followedStores()->create($request->all());
            return response()->json(['followed_store' => $followedStore]);
        } else {
            return response()->json(['message' => "You already followed this store  "], 403);
        }
    }

    public function delete($id)
    {
        $store = FollowedStore::find($id);
        $store->delete();
    }

    public function userFollowedStores()
    {
        $stores = auth()->user()->followedStores()->with('store')->paginate(10);
        return response()->json(['stores' => $stores]);
    }

}
