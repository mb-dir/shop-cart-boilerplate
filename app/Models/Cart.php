<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_quantity', 'total_price', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function recalculate()
    {
        $total_quantity = $this->items->sum('quantity');

        $total_price = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // delete cart when user has deleted all items
        if ($total_quantity === 0) {
            $this->deleteCart();
            return;
        };

        $this->update([
            'total_quantity' => $total_quantity,
            'total_price' => $total_price,
        ]);

        session()->put('cart', $this);
    }

    public function deleteCart()
    {
        $this->delete();

        session()->forget('cart');
    }

    public function makeInactive()
    {
        $this->update(['is_active' => 0]);

        session()->forget('cart');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($cart) {
            session()->put('cart', $cart);
        });
    }
}
