<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCreateValidation;
use App\Http\Requests\StoreUpdateValidation;
use App\Models\User;
use App\Models\Store;

class StoreController extends Controller
{

    public function create(StoreCreateValidation $request)
    {
        if(!auth()->user()->alreadyHaveStore()) {
            $store = auth()->user()->store()->create($request->all());
            return response()->json(['store' => $store]);
        }else {
            return response()->json([
                'already_have_store' => 'User already have registered store'
            ], 403);
        }
    }

    
    public function delete($id) 
    {
        
    }

    public function update(Request $request, $id)
    {
        return response()->json($request->all());
    }

    public function updateMyStore(StoreUpdateValidation $request)
    {
        $store = auth()->user()->store()->first();
        $store->update($request->all());
        return response()->json(['store' => $store]);
    }

    public function updateStoreImage(Request $request)
    {
        $store = auth()->user()->store()->first();
        $image = $request->image;

        $imageName = "store_image_".rand().$store->id.time().".".$image->getClientOriginalExtension();
        Storage::delete('/public/images/store_images/'.$store->id.'/'.$store->image);
        $path = $image->storeAs('/public/images/store_images/'.$store->id, $imageName);
        $storeImage = $store->update(['image' => $imageName]);
        return response()->json(['store' => $store]);
    }

    public function followStore($id)
    {
        
    }

    public function acceptStore($id) {
        $store = Store::findOrFail($id);
        $store->update(['status' => 'active']);
        return response()->json(['store' => $store]);
    }

}
