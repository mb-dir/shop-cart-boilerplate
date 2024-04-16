<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(int $id)
    {

        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        if(is_null($cart)){
            $cart = [
                $id = [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => 1,
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('message', "Added to cart!");
        }

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('message', 'Added to cart!');
        }

        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "quantity" => 1
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('message', 'Added to cart!');
    }
}
