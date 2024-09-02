<?php

namespace App\Http\Controllers;

use App\Facades\Cart as FacadesCart;
use App\Mail\OrderEmail;
use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get()->load('status', 'paymentType', 'deliveryType');

        $unconfirmedOrders = $orders->filter(function ($order) {
            return $order->status_id === 1;
        })->values()->toArray(); // Convert to array and reindex

        $confirmedOrders = $orders->filter(function ($order) {
            return $order->status_id === 2;
        })->values()->toArray(); // Convert to array and reindex

        return Inertia::render('Order/Index', compact('confirmedOrders', 'unconfirmedOrders'));
    }

    public function show(Order $order)
    {
        $order->load('cart.items', 'status', 'paymentType', 'deliveryType');

        return Inertia::render('Order/Show', compact('order'));
    }

    public function create()
    {
        return Inertia::render('Order/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => "required",
            'main_street' => "required",
            'house_number' => "required",
            'phone' => "required",
            'payment_type_id' => 'required',
            'delivery_type_id' => 'required',
        ]);

        $validated['cart_id'] = FacadesCart::id();
        $validated['user_id'] = Auth::id();
        $validated['status_id'] = 1;

        $order = Order::create($validated);

        FacadesCart::makeInactive();

        return redirect(route('order.summary', compact('order')))->with('message', 'Order was created!');
    }

    public function summary(Order $order)
    {
        $order->load('cart.items', 'status', 'deliveryType', 'paymentType');

        return Inertia::render('Order/Summary', compact('order'));
    }

    public function confirm(Order $order)
    {
        // Kinda sus too
        $order->update(['status_id' => 2]);
        $userEmail = Auth::user()->email;

        Mail::to($userEmail)->send(new OrderEmail($order));

        return redirect(route('order.index'))->with('message', 'Order was confirmed!');
    }
}
