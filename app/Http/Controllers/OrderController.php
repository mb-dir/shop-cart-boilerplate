<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
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
            'house_number' => "required",
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


        $order = Order::create($validated);

        return redirect(route('order.summary', compact('order')))->with('message', 'Order was created!');
    }

    public function summary(Order $order)
    {
        $order->load('cart.items');

        return Inertia::render('Order/Summary', compact('order'));
    }

    public function confirm(Order $order)
    {
        $order->update(['status' => 1]);

        return redirect(route('profile.edit'))->with('message', 'Order was canfirmed!');
    }
}
