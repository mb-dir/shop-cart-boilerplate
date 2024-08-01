<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
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

        $product = Product::find($id);

        $cart = session()->get('cart');

        if (!is_null($cart)) {
            $newItem = CartItem::create(['cart_id' => $cart->id, 'name' => $product->name, 'price' => $product->price, 'sequence' => 1, 'product_id' => $product->id, 'quantity' => $newQuantity]);
        }

        return redirect()->back()->with('message', "Added to cart!");
    }

    public function deleteItem(int $id)
    {
        $cart = session()->get('cart');

        unset($cart['items'][$id]);

        // Recalculate total price and quantity
        $cart['totalPrice'] = 0;
        $cart['totalQuantity'] = 0;
        foreach ($cart['items'] as $item) {
            $cart['totalPrice'] += $item['price'] * $item['quantity'];
            $cart['totalQuantity'] += $item['quantity'];
        }

        // If the cart is empty, reset the session
        if (empty($cart['items'])) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('message', "Item was del!eted");
    }
}
