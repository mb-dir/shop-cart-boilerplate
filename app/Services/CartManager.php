<?php

namespace App\Services;

use App\Models\Cart;

class CartManager
{
    private ?Cart $cart;

    public function create()
    {
        $this->cart = Cart::create(['user_id' => 1, 'total_quantity' => 0, 'total_price' => 0, 'is_active' => 0]);

        return $this->cart;
    }
}
