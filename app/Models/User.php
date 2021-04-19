<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'contact',
        'address',
        'image'
    ];

    protected $attributes = [
        'image' => 'none',
        'address' => 'none',
        'role' => 'user'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function store()
    {
        return $this->hasOne(Store::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function followedStores()
    {
        return $this->hasMany(FollowedStore::class, 'user_id');
    }

    public function savedProducts()
    {
        return $this->hasMany(SavedProduct::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // ================ FUNCTIONS ==================

    public function fullName()
    {
        $fullName = "".$this->firstname." ".$this->lastname."";
        return $fullName;
    }

    public function alreadyHaveStore()
    {
        $store = $this->store()->first();
        if($store) { return true; }
    }

    public function alreadyHaveInCart($product_id)
    {
        $cart = $this->carts()->where('product_id', $product_id)->where('status', 'oncart')->exists();
        return $cart;
    }

    public function alreadyFollowedStore($store_id)
    {
        $store = $this->followedStores()->where('store_id', $store_id)->exists();
        return $store;
    }

    public function alreadySavedProduct($product_id)
    {
        $product = $this->savedProducts()->where('product_id', $product_id)->exists();
        return $product;
    }

}
