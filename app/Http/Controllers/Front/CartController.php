<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        if(!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must login first');
        }

        $cartItems = session()->get('cart') ?? [];
        return view('frontend.cart' ,compact('cartItems'));
    }

    public function addToCartSession($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must login first');
        }

        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found');
        }


        // -------------------- cart operations -------------------- array
        $cart = session()->get('cart') ?? [];

        // -------------------- check if product exists in cart -------------------- 
        if (!array_key_exists($product->id, $cart)) {
            $cart[$product->id] = [
                'title' => $product->title,
                'price' => $product->discount_price ?? $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        } else {
            $cart[$product->id]['quantity']++;
        }

        session()->put('cart', $cart);
        Log::info(session()->get('cart'));
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
}
