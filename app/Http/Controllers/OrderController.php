<?php

namespace App\Http\Controllers;


use App\Facades\Cart as FacadesCart;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Mail\OrderEmail;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;


class OrderController extends Controller
{

    public function confirm(Order $order)
    {
        // Kinda sus too
        $order->update(['status_id' => 2]);
        $userEmail = Auth::user()->email;

        Mail::to($userEmail)->send(new OrderEmail($order));

        return redirect(route('order.index'))->with('message', 'Order was confirmed!');
    }


    public function create()
    {
        return Inertia::render('Order/Create');
    }


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
        $order->load('cart.items', 'status', 'paymentType', 'deliveryType', 'currency');

        return Inertia::render('Order/Show', compact('order'));
    }


    public function store(CreateOrderRequest $request)
    {
        $validated = $request->validated();

        $validated['cart_id'] = FacadesCart::id();
        $validated['user_id'] = Auth::id();
        $validated['currency_id'] = Currency::firstWhere('is_active', 1)->id;
        $validated['status_id'] = 1;

        $order = Order::create($validated);

        FacadesCart::makeInactive();

        return redirect(route('order.summary', compact('order')))->with('message', 'Order was created!');
    }


    public function summary(Order $order)
    {
        $order->load('cart.items', 'status', 'deliveryType', 'paymentType', 'currency');

        return Inertia::render('Order/Summary', compact('order'));
    }
}
