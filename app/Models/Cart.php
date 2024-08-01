<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['totalPrice', 'totalQuantity'];

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

        $this->update([
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
        ]);

        session()->put('cart', $this);
    }
}
