@extends('layouts.frontend')

@section('title', 'Shopping Cart')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <h1 style="margin-bottom: 2rem;">Your Shopping Cart</h1>
    
    @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
    @endif
    
    @if(count($cartItems) > 0)
    <div class="cart-container">
        <div class="cart-items" style="margin-bottom: 2rem;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #ccc;">
                        <th style="text-align: left; padding: 0.75rem;">Product</th>
                        <th style="text-align: right; padding: 0.75rem;">Price</th>
                        <th style="text-align: center; padding: 0.75rem;">Quantity</th>
                        <th style="text-align: right; padding: 0.75rem;">Subtotal</th>
                        <th style="text-align: center; padding: 0.75rem;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 1rem 0.75rem;">
                            <div style="display: flex; align-items: center;">
                                <div style="width: 80px; height: 80px; margin-right: 1rem; background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ $item['product']->image_path ?? '/img/placeholder.jpg' }}" alt="{{ $item['product']->name }}" style="max-width: 100%; max-height: 100%;">
                                </div>
                                <div>
                                    <h3 style="margin: 0; font-size: 1rem;">{{ $item['product']->name }}</h3>
                                </div>
                            </div>
                        </td>
                        <td style="text-align: right; padding: 0.75rem;">${{ number_format($item['price'], 2) }}</td>
                        <td style="text-align: center; padding: 0.75rem;">
                            <form action="{{ route('cart.update') }}" method="POST" style="display: flex; align-items: center; justify-content: center;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px; padding: 0.5rem; text-align: center; border: 1px solid #ccc; border-radius: 4px;">
                                <button type="submit" style="background: var(--color-blue-1); color: white; border: none; padding: 0.5rem; border-radius: 4px; margin-left: 0.5rem; cursor: pointer;">Update</button>
                            </form>
                        </td>
                        <td style="text-align: right; padding: 0.75rem; font-weight: 600;">${{ number_format($item['subtotal'], 2) }}</td>
                        <td style="text-align: center; padding: 0.75rem;">
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <a href="/products" style="color: var(--color-blue-1);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                        <path d="M19 12H5"></path>
                        <path d="M12 19l-7-7 7-7"></path>
                    </svg>
                    Continue Shopping
                </a>
            </div>
            
            <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 300px;">
                <h3 style="margin-top: 0; margin-bottom: 1rem;">Order Summary</h3>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Shipping</span>
                    <span>Calculated at checkout</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee; font-weight: 600;">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div style="margin-top: 1.5rem;">
                    <a href="{{ route('checkout.index') }}" style="display: block; background-color: var(--color-dark-blue-2); color: white; padding: 0.75rem; text-align: center; border-radius: 4px; font-weight: 500;">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div style="text-align: center; padding: 3rem 0;">
        <p style="margin-bottom: 1.5rem; font-size: 1.1rem;">Your cart is empty.</p>
        <a href="/products" style="display: inline-block; background-color: var(--color-blue-1); color: white; padding: 0.75rem 1.5rem; border-radius: 4px; font-weight: 500;">Start Shopping</a>
    </div>
    @endif
</div>
@endsection