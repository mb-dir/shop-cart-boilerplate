<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'totalQuantity', 'totalPrice'];

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
        return $this->belongsTo(Order::class);
    }

    public function recalculate()
    {
        $totalQuantity = $this->items->sum('quantity');

        $totalPrice = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // delete cart when user has deleted all items
        if ($totalQuantity === 0) {
            $this->deleteCart();
            return;
        };

        $this->update([
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
        ]);

        session()->put('cart', $this);
    }

    public function deleteCart()
    {
        $this->delete();

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
