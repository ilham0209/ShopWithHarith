<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->take(8)
            ->get();
            
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->take(6)
            ->get();
            
        return view('home', compact('featuredProducts', 'categories'));
    }
}