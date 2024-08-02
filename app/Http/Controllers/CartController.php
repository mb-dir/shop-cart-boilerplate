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
    public function addToCart(Request $request, Product $product)
    {
        $newQuantity = $request->input('quantity', 1);

        $cart = session()->get('cart');

        if (!is_null($cart)) {
            $retrivedItem = $cart->items()->firstWhere('product_id', $product->id);
            if (!is_null($retrivedItem)) {
                $retrivedItem->quantity = $newQuantity;
                $retrivedItem->save();
            } else {
                CartItem::create(['cart_id' => $cart->id, 'name' => $product->name, 'price' => $product->price, 'sequence' => 1, 'product_id' => $product->id, 'quantity' => $newQuantity]);
            }
        }

        return redirect()->back()->with('message', "Added to cart!");
    }

    public function deleteItem(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('message', "Item was deleted!");
    }
}
