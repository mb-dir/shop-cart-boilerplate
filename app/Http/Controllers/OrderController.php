<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $cart = Cart::firstWhere('user_id', Auth::id())->load('items');
        return Inertia::render('Order', compact('cart'));
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
        $cart = Cart::firstWhere('user_id', Auth::id());


        $validated['cart_id'] = $cart->id;
        $validated['user_id'] = Auth::id();


        Order::create($validated);


        return redirect(route('product.index'))->with('message', 'Order created');
    }
}
