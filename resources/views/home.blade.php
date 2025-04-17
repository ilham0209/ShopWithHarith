@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
<div class="hero-section" style="background-color: var(--color-dark-blue-2); padding: 5rem 0; margin-bottom: 3rem;">
    <div class="container">
        <div class="hero-content" style="color: white; max-width: 600px;">
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Discover Your Style</h1>
            <p style="font-size: 1.1rem; margin-bottom: 2rem;">Shop the latest trends with ShopWithHarith. Quality products at affordable prices.</p>
            <a href="/products" style="background-color: var(--color-blue-2); color: white; padding: 0.75rem 1.5rem; border-radius: 4px; font-weight: 500; display: inline-block;">Shop Now</a>
        </div>
    </div>
</div>

<div class="container">
    <section class="featured-section" style="margin-bottom: 3rem;">
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--color-dark-blue-1);">Featured Products</h2>
        
        <div class="featured-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem;">
            @foreach($featuredProducts as $product)
            <div class="product-card" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <div class="product-image" style="height: 200px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ $product->image_path ?? '/img/placeholder.jpg' }}" alt="{{ $product->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
                <div class="product-info" style="padding: 1rem;">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1.1rem;">{{ $product->name }}</h3>
                    <div class="product-price" style="display: flex; align-items: center; margin-bottom: 1rem;">
                        @if($product->sale_price)
                        <span style="color: var(--color-blue-1); font-weight: 600; font-size: 1.1rem;">${{ $product->sale_price }}</span>
                        <span style="color: #888; text-decoration: line-through; margin-left: 0.5rem;">${{ $product->price }}</span>
                        @else
                        <span style="color: var(--color-blue-1); font-weight: 600; font-size: 1.1rem;">${{ $product->price }}</span>
                        @endif
                    </div>
                    <a href="/products/{{ $product->slug }}" style="display: block; text-align: center; background-color: var(--color-blue-1); color: white; padding: 0.5rem; border-radius: 4px; font-weight: 500;">View Product</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    
    <section class="categories-section" style="margin-bottom: 3rem;">
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--color-dark-blue-1);">Shop by Category</h2>
        
        <div class="categories-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem;">
            @foreach($categories as $category)
            <a href="/categories/{{ $category->slug }}" class="category-card" style="position: relative; height: 150px; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-weight: 600; font-size: 1.2rem;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: var(--color-blue-1); opacity: 0.8; z-index: 1;"></div>
                <span style="position: relative; z-index: 2;">{{ $category->name }}</span>
            </a>
            @endforeach
        </div>
    </section>
</div>
@endsection