<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        foreach ($request->order as $order) {
            if($order != null) {
                $product = Product::findOrFail($order['cart']['product_id']);
                $cart = Cart::find($order['cart']['id']);
                $cart->status = "pending";
                $cart->save();

                $trackingNumber = rand().$order['cart']['product_id'].time();

                $order = Order::create([
                    'cart_id'           => $cart->id,
                    'quantity'          => $order['cart']['quantity'],
                    'payment_options'   => $request->payment_option,
                    'tracking_number'   => $trackingNumber,
                    'user_id'           => auth()->id(),
                    'product_id'        => $product->id,
                    'total_price'       => $product->price * $order['cart']['quantity'],
                    'store_id'           => $product->store_id
                ]);
            }
        }
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }

    public function find($id)
    {
        $order = Order::findOrFail($id);
        return response()->json([
            'order' => $order,
            'product' => $order->product()->with('images')->first(),
            'store' => $order->store()->first(),
        ]);
    }

    public function myOrders()
    {
        $orders = auth()->user()->orders()->with('product.images')->orderBy('created_at', 'DESC')->paginate(5);
        return response()->json(['orders' => $orders]);
    }

}
