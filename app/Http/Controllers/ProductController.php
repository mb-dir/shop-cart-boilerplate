<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartManager;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return Inertia::render("Product/Index", compact('products'));
    }

    public function show(Product $product)
    {
        return Inertia::render("Product/Show", compact('product'));
    }
}
