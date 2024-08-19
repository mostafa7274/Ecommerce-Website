<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::get();
        return view('cart.index' , compact('carts'));
    }


    public function create()
    {
        return view('cart.create' , compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addToCart(Request $request, $productId)
{
    $user = auth()->user();


    $cart = $user->cart()->firstOrCreate([]);


    $product = Product::findOrFail($productId);


    $existingProduct = $cart->products()->where('product_id', $productId)->first();

    if ($existingProduct) {

        $cart->products()->updateExistingPivot($product->id, [
            'quantity' => DB::raw('quantity + 1')
        ], false);
    } else {

        $cart->products()->attach($product->id, ['quantity' => 1]);
    }

    return redirect()->route('cart.show');
}


public function removeFromCart(Request $request, $productId)
{
    $user = auth()->user();
    $cart = $user->cart;

    // Remove the product from the cart
    $cart->products()->detach($productId);

    return redirect()->route('cart.show');
}


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();
        $cart = $user->cart;

        // Load related products with quantity
        $cartItems = $cart->products()->withPivot('quantity')->get();

        return view('cart.show', compact('cartItems'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
