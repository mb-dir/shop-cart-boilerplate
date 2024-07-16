<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart');
        return Inertia::render('Cart', compact('cart'));
    }

    // We pass product id instead of the whole product, cuz id is used as array key which represents given product
    public function addToCart(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart', [
            'items' => [],
            'totalPrice' => 0,
            'totalQuantity' => 0,
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

        // Update total price and number of items in cart
        $cart['totalPrice'] += $product->price;
        $cart['totalQuantity'] += 1;

        session()->put('cart', $cart);

        return redirect()->back()->with('message', "Added to cart!");
    }
}
