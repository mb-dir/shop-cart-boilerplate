<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use App\Services\CartItemManager;

class CartItemController extends Controller
{

    protected $cartItemManager;

    public function __construct(CartItemManager $cartItemManager)
    {
        $this->cartItemManager = $cartItemManager;
    }

    public function store(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        $this->cartItemManager->create($product, $quantity);

        return redirect()->back()->with('message', "Added to cart!");
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $quantity = $request->input('quantity', null);

        $this->cartItemManager->update($cartItem, $quantity);

        return redirect()->back()->with('message', "Item was updated");
    }

    public function destory(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('message', "Item was deleted!");
    }
}
