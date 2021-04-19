<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductCreateValidation;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\User;

class ProductController extends Controller
{
    
    public function create(ProductCreateValidation $request)
    {   
        $store = auth()->user()->store()->first();
        $product = $store->products()->create($request->except('code') + [
            'code' => "".rand().$store->id."".time()
        ]);

        if($request->has('image')) 
        {
            foreach($request->image as $image) 
            {
                $imageName = "shopping_app_product_".rand().$product->id.time().".".$image->getClientOriginalExtension();
                $path = $image->storeAs('/public/images/product_images/'.$product->id, $imageName);
                $productImage = $product->images()->create(['image' => $imageName]);
            }
        }
        return response()->json(['product' => $product]);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function update(Request $request, $id)
    {   
        $store = auth()->user()->store()->first();
        $product = Product::find($id);
        $product->update($request->except('store_id') + ['store_id' => $store->id]);
        $product->tags()->delete();

        if($request->has('image'))
        {
            foreach($product->images()->get() as $image) 
            {
                $product->images()->delete();
				Storage::delete('/public/images/product_images/'.$product->id.'/'.$image->image);
            }

            foreach($request->image as $image) 
            {
                $imageName = "shopping_app_product_".rand().$product->id.time().".".$image->getClientOriginalExtension();
                $path = $image->storeAs('/public/images/product_images/'.$product->id, $imageName);
                $productImage = $product->images()->create(['image' => $imageName]);
            }
        }
        return response()->json([
            'product' => $product,
            'store' => $product->store()->first(),
            'images' => $product->images()->get()
        ]);
    }

    public function archive($id) 
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'archived']);
    }

    public function removeArchive($id) 
    {
        $product = Product::find($id);
        $product->update(['status' => 'active']);
    }

    public function acceptRequest($id)
    {
        $product = Product::find($id);
        $product->update(['status' => 'active']);
    }

    public function declineRequest($id)
    {
        $product = Product::find($id);
        $product->delete();
    }

    public function find($id) 
    {
        $product = Product::find($id);
        return response()->json([
            'product' => $product,
            'images' => $product->images()->get(),
            'store' => $product->store()->first(),
        ]);
    }

}
