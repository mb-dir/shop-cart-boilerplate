<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;

class CartItemManager
{

    private CartManager $cartManager;

    public function __construct(CartManager $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    // Add totally new item
    public function create(Product $product, int $quantity)
    {
        $cart = $this->cartManager->create();

        $attributes = ['cart_id' => $cart->id, 'name' => $product->name, 'price' => $product->price,  'product_id' => $product->id, 'quantity' => $quantity];

        CartItem::create($attributes);

        $this->cartManager->recalculate();
    }

    public function update(CartItem $cartItem, mixed $quantity)
    {

        if (is_null($quantity)) {
            $cartItem->quantity += 1;
        } else {
            $cartItem->quantity = $quantity;
        }

        $cartItem->save();

        $this->cartManager->recalculate();
    }
}
