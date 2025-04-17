@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <h1 style="margin-bottom: 2rem;">Checkout</h1>
    
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
            <!-- Shipping Information -->
            <div style="flex: 1; min-width: 300px;">
                <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.3rem;">Shipping Information</h2>
                    
                    <div style="margin-bottom: 1rem;">
                        <label for="shipping_address" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Address</label>
                        <input type="text" id="shipping_address" name="shipping_address" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                        @error('shipping_address')
                        <div style="color: #dc3545; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label for="shipping_city" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">City</label>
                        <input type="text" id="shipping_city" name="shipping_city" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                        @error('shipping_city')
                        <div style="color: #dc3545; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                        <div style="flex: 1;">
                            <label for="shipping_state" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">State/Province</label>
                            <input type="text" id="shipping_state" name="shipping_state" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('shipping_state')
                            <div style="color: #dc3545; margin-top: 0.25rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div style="flex: 1;">
                            <label for="shipping_zip" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">ZIP/Postal Code</label>
                            <input type="text" id="shipping_zip" name="shipping_zip" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                            @error('shipping_zip')
                            <div style="color: #dc3545; margin-top: 0.25rem;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label for="shipping_country" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Country</label>
                        <select id="shipping_country" name="shipping_country" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                            <option value="">Select Country</option>
                            <option value="US">United States</option>
                            <option value="CA">Canada</option>
                            <option value="UK">United Kingdom</option>
                            <!-- Add more countries as needed -->
                        </select>
                        @error('shipping_country')
                        <div style="color: #dc3545; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.3rem;">Payment Method</h2>
                    
                    <div style="margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <input type="radio" id="credit_card" name="payment_method" value="credit_card" checked style="margin-right: 0.5rem;">
                            <label for="credit_card">Credit Card</label>
                        </div>
                        
                        <div style="display: flex; align-items: center;">
                            <input type="radio" id="paypal" name="payment_method" value="paypal" style="margin-right: 0.5rem;">
                            <label for="paypal">PayPal</label>
                        </div>
                        
                        @error('payment_method')
                        <div style="color: #dc3545; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- For simplicity, we're not collecting actual payment information in this tutorial -->
                    <div class="payment-fields" id="credit_card_fields">
                        <p style="color: #6c757d; font-style: italic;">Note: This is a demonstration. No actual payment will be processed.</p>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div style="width: 350px;">
                <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); position: sticky; top: 2rem;">
                    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.3rem;">Order Summary</h2>
                    
                    <div style="margin-bottom: 1.5rem;">
                        @foreach($cartItems as $item)
                        <div style="display: flex; margin-bottom: 1rem;">
                            <div style="width: 60px; height: 60px; margin-right: 1rem; background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                                <img src="{{ $item['product']->image_path ?? '/img/placeholder.jpg' }}" alt="{{ $item['product']->name }}" style="max-width: 100%; max-height: 100%;">
                            </div>
                            <div style="flex: 1;">
                                <h3 style="margin: 0; font-size: 0.9rem;">{{ $item['product']->name }}</h3>
                                <div style="display: flex; justify-content: space-between; margin-top: 0.25rem;">
                                    <span style="color: #6c757d; font-size: 0.9rem;">{{ $item['quantity'] }} × ${{ number_format($item['price'], 2) }}</span>
                                    <span style="font-weight: 600;">${{ number_format($item['subtotal'], 2) }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div style="border-top: 1px solid #eee; padding-top: 1rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span>Tax</span>
                            <span>$0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee; font-weight: 600;">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <button type="submit" style="width: 100%; background-color: var(--color-dark-blue-2); color: white; padding: 0.75rem; text-align: center; border-radius: 4px; font-weight: 500; border: none; cursor: pointer;">Complete Order</button>
                    </div>
                    
                    <div style="margin-top: 1rem; text-align: center;">
                        <a href="{{ route('cart.index') }}" style="color: var(--color-blue-1); font-size: 0.9rem;">Return to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection