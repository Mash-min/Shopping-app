<?php

namespace App\Http\Controllers\Json;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ProductJsonController extends Controller
{
    public function products()
    {
        $products = Product::orderBy('name', 'ASC')->where('status','active')->with('images')->paginate(8);
        return response()->json(['products' => $products]);
    }

    public function find($id)
    {
        $product = Product::find($id);
        return response()->json([
            'product' => $product, 
            'images' => $product->images()->get(),
            'tags' => $product->tags()->get()
        ]);
    }

    public function findProductCode($code)
    {
        $product = Product::where('code', $code)->first();
        return response()->json([
            'product' => $product, 
            'images' => $product->images()->get(),
            'tags' => $product->tags()->get()
        ]);
    }

    public function productReviews($code)
    {
        $product = Product::where('code', $code)->first();
        $reviews = $product->reviews()->with('user')->paginate(10);
        return response()->json([
            'reviews' => $reviews,
            'user_id' => auth()->user()->id
        ]);
    }

    public function searchProduct($search)
    {
        $product = Product::orderBy('name', 'DESC')->where('name', 'like', '%'.$search.'%')->with('images')->paginate(8);
        return response()->json(['products' => $product]);
    }


    public function adminProductList()
    {
        $products = Product::orderBy('name', 'ASC')->whereNotIn('status', ['archived', 'pending'])
                                                   ->with('store.user')
                                                   ->with('images')
                                                   ->paginate(10);
        return response()->json(['products' => $products]);
    }

    public function adminProductListSearch($data)
    {
        $products = Product::orderBy('name', 'ASC')->where([
                                                        ['name', 'like', '%'.$data.'%']
                                                    ])
                                                   ->whereNotIn('status', ['archived', 'pending'])
                                                   ->orWhere([
                                                       ['code', $data]
                                                   ])
                                                   ->whereNotIn('status', ['archived', 'pending'])
                                                   ->with('store.user')
                                                   ->with('images')
                                                   ->paginate(10);
        return response()->json(['products' => $products]);
    }

    public function adminProductRequest()
    {
        $products = Product::orderBy('name', 'ASC')->where('status', 'pending')
                                                   ->with('store.user')
                                                   ->with('images')
                                                   ->paginate(10);
        return response()->json(['products' => $products]);
    }

    public function adminProductRequestSearch($data) 
    {
        $products = Product::orderBy('name', 'ASC')->where('status', 'active')
                                                   ->where('name', 'like', '%'.$data.'%')
                                                   ->orWhere('code', 'like', '%'.$data.'%')
                                                   ->with('store.user')
                                                   ->with('images')
                                                   ->paginate(10);
        return response()->json(['products' => $products]);
    }

    public function adminProductArchive()
    {
        $products = Product::orderBy('name', 'ASC')->where('status', 'archived')
                                                   ->with('store.user')
                                                   ->with('images')
                                                   ->paginate(10);
        return response()->json(['products' => $products]);                                           
    }

}
