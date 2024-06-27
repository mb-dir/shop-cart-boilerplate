<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // We pass product id instead of the whole product, cuz id is used as array key which represents given product
    public function addToCart(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart', [
            'items' => [],
            'total' => 0
        ]);

        // Adding new item when initializing cart
        if (!isset($cart['items'][$id])) {
            $cart['items'][$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1
            ];
        } else {
            // Adding existing item
            $cart['items'][$id]['quantity']++;
        }

        // Update total price
        $cart['total'] += $product->price;

        session()->put('cart', $cart);

        return redirect()->back()->with('message', "Added to cart!");
    }
}
