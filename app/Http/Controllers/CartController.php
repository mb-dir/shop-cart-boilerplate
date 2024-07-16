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
    public function addToCart(Request $request, int $id)
    {
        $newQuantity = $request->input('quantity', 1);

        if ($newQuantity < 1) {
            return redirect()->back()->with('error', "Invalid quantity.");
        }

        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart', [
            'items' => [],
            'totalPrice' => 0,
            'totalQuantity' => 0,
        ]);

        if (isset($cart['items'][$id])) {
            // Update item quantity
            $cart['items'][$id]['quantity'] = $newQuantity;
        } else {
            // Add new item
            $cart['items'][$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $newQuantity,
            ];
        }

        // Recalculate total price and quantity
        $cart['totalPrice'] = 0;
        $cart['totalQuantity'] = 0;
        foreach ($cart['items'] as $item) {
            $cart['totalPrice'] += $item['price'] * $item['quantity'];
            $cart['totalQuantity'] += $item['quantity'];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('message', "Added to cart!");
    }
}
