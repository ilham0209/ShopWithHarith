@extends('layouts.frontend')

@section('title', 'Order Confirmation')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <div style="max-width: 800px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--color-blue-1)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <h1 style="margin-top: 1rem; color: var(--color-dark-blue-1);">Thank You!</h1>
            <p style="font-size: 1.1rem; color: var(--color-blue-1);">Your order has been received.</p>
        </div>
        
        <div style="margin-bottom: 2rem;">
            <h2 style="margin-bottom: 1rem; font-size: 1.3rem;">Order Details</h2>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                <div>
                    <p style="margin-bottom: 0.25rem; color: #6c757d;">Order Number:</p>
                    <p style="font-weight: 600;">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p style="margin-bottom: 0.25rem; color: #6c757d;">Date:</p>
                    <p style="font-weight: 600;">{{ $order->created_at->format('F j, Y') }}</p>
                </div>
                <div>
                    <p style="margin-bottom: 0.25rem; color: #6c757d;">Total:</p>
                    <p style="font-weight: 600;">${{ number_format($order->total_amount, 2) }}</p>
                </div>
                <div>
                    <p style="margin-bottom: 0.25rem; color: #6c757d;">Payment Method:</p>
                    <p style="font-weight: 600;">{{ ucfirst($order->payment_method) }}</p>
                </div>
            </div>
        </div>
        
        <div style="margin-bottom: 2rem;">
            <h2 style="margin-bottom: 1rem; font-size: 1.3rem;">Order Summary</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #eee;">
                        <th style="text-align: left; padding: 0.75rem;">Product</th>
                        <th style="text-align: right; padding: 0.75rem;">Price</th>
                        <th style="text-align: center; padding: 0.75rem;">Quantity</th>
                        <th style="text-align: right; padding: 0.75rem;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 0.75rem;">{{ $item->product->name }}</td>
                        <td style="text-align: right; padding: 0.75rem;">${{ number_format($item->unit_price, 2) }}</td>
                        <td style="text-align: center; padding: 0.75rem;">{{ $item->quantity }}</td>
                        <td style="text-align: right; padding: 0.75rem;">${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right; padding: 0.75rem; font-weight: 600;">Total:</td>
                        <td style="text-align: right; padding: 0.75rem; font-weight: 600;">${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div style="margin-bottom: 2rem;">
            <h2 style="margin-bottom: 1rem; font-size: 1.3rem;">Shipping Information</h2>
            <p style="margin-bottom: 0.25rem;">{{ $order->shippingAddress->address_line_1 }}</p>
            <p style="margin-bottom: 0.25rem;">{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->postal_code }}</p>
            <p>{{ $order->shippingAddress->country }}</p>
        </div>
        
        <div style="text-align: center; margin-top: 2rem;">
            <a href="/" style="display: inline-block; background-color: var(--color-blue-1); color: white; padding: 0.75rem 1.5rem; border-radius: 4px; font-weight: 500;">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection