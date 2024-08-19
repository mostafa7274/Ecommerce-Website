<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure you are using Auth facade
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Apply the SellerAuth middleware to ensure only authenticated sellers can access these methods.
     */
    public function __construct()
    {
        $this->middleware('seller.auth'); // Apply the SellerAuth middleware
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::where('seller_id', Auth::guard('seller')->user()->id)->get();


        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:10|max:2000',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $seller = Auth::guard('seller')->user();
        if (!$seller) {
            return redirect('/seller/dashboard/login')->with('error', 'You must be logged in as a seller to add a product.');
        }


        if (in_array($seller->id, Cache::get('blocked_sellers', []))) {
            return redirect()->back()->with('error', 'You are blocked from adding products.');
        }


        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->seller_id = $seller->id;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();


            $destinationPath = public_path('images/stored_images');

            // Create the directory if it does not exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Move the uploaded file to the destination directory
            $image->move($destinationPath, $imageName);


            $product->image = 'stored_images/' . $imageName;
        }


        $product->save();


        return redirect()->route('products')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
    }
}
