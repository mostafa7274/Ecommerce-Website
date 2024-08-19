<?php

namespace App\Http\Controllers;

use App\Models\Product;

class buyerController extends Controller
{
    public function showApprovedProducts()
    {

        $products = Product::where('status', 'approved')->get();
        return view('welcome', compact('products')); // this views my welcome.blade.php file
    }

    public function show($id)
    {
        if (is_null($id)) {
            abort(404, 'Product not found');
        }

        
        $product = Product::with('seller')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
