<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\SavedProduct;

class SavedProductControler extends Controller
{
    
    public function create(Request $request)
    {
        if(!auth()->user()->alreadySavedProduct($request->product_id)) 
        {
            $savedProduct = auth()->user()->savedProducts()->create(['product_id' => $request->product_id]);
            return response()->json($savedProduct);
        }else {
            return response()->json(['message' => "You already saved this product"], 403);
        }
    }

    public function delete($id)
    {
        $savedProduct = SavedProduct::find($id);
        $savedProduct->delete();
    }

    public function userSavedProducts()
    {
        $products = auth()->user()->savedProducts()->with('product.images')->paginate(5);
        return response()->json(['products' => $products]);
    }

}
