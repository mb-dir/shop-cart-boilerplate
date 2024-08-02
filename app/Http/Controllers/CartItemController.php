<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart');

        if (!is_null($cart)) {
            CartItem::create(['cart_id' => $cart->id, 'name' => $product->name, 'price' => $product->price, 'sequence' => 1, 'product_id' => $product->id, 'quantity' => $quantity]);
        }

        return redirect()->back()->with('message', "Added to cart!");
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $quantity = $request->input('quantity', 1);

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return redirect()->back()->with('message', "Item was updated");
    }

    public function destory(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('message', "Item was deleted!");
    }
}
