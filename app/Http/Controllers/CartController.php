<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
 
public function create(Request $request)
    {
        if(!auth()->user()->alreadyHaveInCart($request->product_id)) 
        {
            $cart = auth()->user()->carts()->create($request->all());
            return response()->json(['cart' => $cart]);
        }else {
            return response()->json(['message' => "Product already in cart"], 403);
        }
    }

    public function delete($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
    }

    public function myCart()
    {
        $cart = auth()->user()->carts()
                              ->where('status', 'oncart')
                              ->with('product.images')
                              ->orderBy('created_at', 'DESC')
                              ->get();
        return response()->json([
            'cart' => $cart
        ]);
    }

}
