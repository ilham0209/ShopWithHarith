<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.user.id')->only(['manage']);
    }

    public function index()
    {
        $products = Product::where('is_active', true)->latest()->get();
        return view('products.index', compact('products'));
    }

    public function manage()
    {
        \Log::info('Accessing manage method');
        try {
            $products = Product::latest()->get();
            \Log::info('Products retrieved:', ['count' => $products->count()]);
            return view('products.manage', compact('products'));
        } catch (\Exception $e) {
            \Log::error('Error in manage method: ' . $e->getMessage());
            return back()->with('error', 'Unable to load products.');
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Add validation and store logic here
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Add validation and update logic here
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.manage')->with('success', 'Product deleted successfully');
    }
}