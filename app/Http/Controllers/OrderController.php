<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
}
