<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;
        
        foreach($cart as $id => $item) {
            $product = Product::find($id);
            if($product) {
                $price = $product->sale_price ?? $product->price;
                $subtotal = $price * $item['quantity'];
                $cartItems[] = [
                    'id' => $id,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }
        
        return view('cart.index', compact('cartItems', 'total'));
    }
    
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $productId = $validated['product_id'];
        $quantity = $validated['quantity'];
        
        $cart = Session::get('cart', []);
        
        // If product already in cart, update quantity
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity
            ];
        }
        
        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $productId = $validated['product_id'];
        $quantity = $validated['quantity'];
        
        $cart = Session::get('cart', []);
        
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
    }
    
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        
        $productId = $validated['product_id'];
        $cart = Session::get('cart', []);
        
        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }
}