<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function create()
    {
        $cart = optional(
            Cart::where('user_id', Auth::id())
                ->where('is_active', 1)
                ->first()
        )->load('items');
        return Inertia::render('Order/Create', compact('cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => "required",
            'main_street' => "required",
            'house_number' => ["required"],
            'phone' => "required",
            'payment_type' => 'required',
            'delivery_type' => 'required',
        ]);

        $cart = optional(
            Cart::where('user_id', Auth::id())
                ->where('is_active', 1)
                ->first()
        )->load('items');


        $validated['cart_id'] = $cart->id;
        $validated['user_id'] = Auth::id();


        Order::create($validated);

        return redirect(route('product.index'))->with('message', 'Order created');
    }

    public function summary(Request $request)
    {
        $cart = optional(
            Cart::where('user_id', Auth::id())
                ->where('is_active', 1)
                ->first()
        )->load('items');

        $orderData = Arr::only($request->data, [
            'city',
            'main_street',
            'house_number',
            'phone',
            'payment_type',
            'delivery_type'
        ]);

        return Inertia::render('Order/Summary', [
            'cart' => $cart,
            'orderData' => $orderData,
        ]);
    }
}
