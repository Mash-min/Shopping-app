<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        $review = auth()->user()->reviews()->create([
            'product_id' => $request->product_id,
            'message' => $request->message
        ]);

        return response()->json([
            'review' => $review,
            'user' => $review->user()->first()
        ]);
    }

    public function delete($id)
    {
        $review = Review::find($id);
        $review->delete();
    }

    public function find($id)
    {
        $review = Review::find($id);
        return response()->json([
            'review' => $review,
            'user' => $review->user()->first()
        ]);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        $review->update(['message' => $request->message]);
        return response()->json([
            'review' => $review,
            'user' => $review->user()->first()
        ]);
    }
}
