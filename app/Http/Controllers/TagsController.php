<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tags;

class TagsController extends Controller
{
    
    public function create(Request $request)
    {
        foreach($request->tags as $tag)
        {
            $tag = Tags::create([
                'data' => $tag,
                'product_id' => $request->product_id
            ]);
        }
    }

}
