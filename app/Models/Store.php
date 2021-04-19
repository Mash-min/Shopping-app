<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'contact',
        'description',
        'image'
    ];

    protected $attributes = [
        'image' => 'none',
        'status' => 'pending'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    public function follows()
    {
        return $this->hasMany(FollowedStore::class, 'store_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'store_id');
    }

}
