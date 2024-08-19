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

    public function update(Product $product, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'],
        ]);

        // You can now use the $validated data to update the product
        $product->update($validated);

        return redirect()->back()->with('message', 'Product updated successfully.');
    }
}
