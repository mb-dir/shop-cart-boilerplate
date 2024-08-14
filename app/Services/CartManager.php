<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartManager
{
    private ?Cart $cart;

    public function create()
    {

        $this->cart = $this->cart();

        if (isset($this->cart)) {
            return $this->cart;
        }

        $this->cart = Cart::create(['user_id' => Auth::id()]);

        return $this->cart;
    }

    public function cart()
    {
        if (isset($this->cart)) {
            return $this->cart;
        }

        $this->cart = Cart::where('user_id', Auth::id())->where('is_active', 1)->first();

        return $this->cart;
    }

    public function shared()
    {
        return optional($this->cart())->load('items');
    }

    public function recalculate()
    {
        $cart = $this->cart->load('items');
        $total_quantity = $cart->items->sum('quantity');

        $total_price = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $cart->update([
            'total_quantity' => $total_quantity,
            'total_price' => $total_price,
        ]);
    }
}
