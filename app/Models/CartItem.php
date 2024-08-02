<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'name', 'price', 'quantity', 'sequence', 'product_id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Overwritte boot method
    public static function boot()
    {
        // Invoke boot method of parent class
        parent::boot();

        static::created(function ($cartItem) {
            $cartItem->cart->recalculate();
        });

        static::updated(function ($cartItem) {
            $cartItem->cart->recalculate();
        });

        static::deleted(function ($cartItem) {
            $cartItem->cart->recalculate();
        });
    }
}
