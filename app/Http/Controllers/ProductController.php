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
            // Retrieve the full URL or path
            $photoUrl = $product->getOriginal('photo');

            // Check if the photo URL is not empty and remove the base URL if needed
            if ($photoUrl) {
                // Extra logic because of the accessor in Product model
                $relativePath = str_replace(asset('storage') . '/', '', $photoUrl);

                // Now, delete the file using the relative path
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
            }

            // Store the new photo and get its relative path
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path;
        } else {
            unset($validated['photo']);
        }

        $product->update($validated);

        return redirect()->back()->with('message', 'Product updated successfully.');
    }
}
