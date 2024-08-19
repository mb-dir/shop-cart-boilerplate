<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::delete($product->photo);
            }

            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path;
        } else {
            unset($validated['photo']);
        }

        $product->update($validated);

        return redirect()->back()->with('message', 'Product updated successfully.');
    }
}
