<?php

namespace App\Services;


use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class CartManager
{
    private ?Cart $cart;


    public function cart()
    {
        if (isset($this->cart)) {
            return $this->cart;
        }

        $this->cart = Cart::where('user_id', Auth::id())->where('is_active', 1)->first();

        return $this->cart;
    }


    public function create()
    {

        $this->cart = $this->cart();

        if (isset($this->cart)) {
            return $this->cart;
        }

        if (Auth::id()) {
            $this->cart = Cart::create(['user_id' => Auth::id()]);

            return $this->cart;
        }

        return null;
    }


    public function destroy()
    {
        if (isset($this->cart)) {
            $this->cart->delete();
            $this->cart = null;
        }
    }


    public function id()
    {
        if (isset($this->cart)) {
            return $this->cart->id;
        }
    }


    public function isEmpty(): bool
    {
        return $this->shared()->items->isEmpty();
    }


    public function makeInactive()
    {
        if (isset($this->cart)) {
            $this->cart->update(['is_active' => 0]);
        }
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


    public function shared()
    {
        return optional($this->cart())->load('items');
    }
}
