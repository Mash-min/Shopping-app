<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'status',
        'name',
        'description',
        'price',
        'discount',
        'srp',
        'quantity',
        'warranty',
        'delivery_fee',
        'availability',
        'code'
    ];

    protected $attributes = [
        'availability' => true,
        'discount' => 0,
        'status' => 'pending'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function tags()
    {
        return $this->hasMany(Tags::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function saves()
    {
        return $this->hasMany(SavedProduct::class, 'product_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }

}
