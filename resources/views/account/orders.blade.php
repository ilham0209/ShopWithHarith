@extends('layouts.frontend')

@section('title', 'My Orders')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <h1 style="margin-bottom: 2rem;">My Orders</h1>
    
    <div style="display: grid; grid-template-columns: 1fr 3fr; gap: 2rem;">
        <!-- Navigation Architecture -->
        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; flex-direction: column; height: 100%;">
            <div style="margin-bottom: 1.5rem;">
                @if($user->name)
                    <h3 style="margin-bottom: 0.5rem;">{{ $user->name }}</h3>
                @endif
                @if($user->email)
                    <p style="color: #666;">{{ $user->email }}</p>
                @endif
            </div>
            
            <nav style="flex-grow: 1;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 0.75rem;">
                        <a href="{{ route('account.index') }}" style="display: block; padding: 0.5rem; color: var(--color-dark-blue-2); background-color: #f5f5f5; border-radius: 4px;">Dashboard</a>
                    </li>
                    <li style="margin-bottom: 0.75rem;">
                        <a href="{{ route('account.orders') }}" style="display: block; padding: 0.5rem; background-color: var(--color-blue-1); color: white; border-radius: 4px;">My Orders</a>
                    </li>
                    <li style="margin-bottom: 0.75rem;">
                        <a href="{{ route('account.profile') }}" style="display: block; padding: 0.5rem; color: var(--color-dark-blue-2); background-color: #f5f5f5; border-radius: 4px;">Profile Settings</a>
                    </li>
                </ul>
            </nav>
            
            <div style="margin-top: auto;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="display: block; width: 100%; text-align: center; padding: 0.75rem; color: white; background-color: #dc3545; border: none; border-radius: 4px; cursor: pointer; font-weight: 500;">Logout</button>
                </form>
            </div>
        </div>
        
        <!-- Orders List -->
        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            @if($orders->isEmpty())
                <div style="text-align: center; padding: 2rem;">
                    <p style="color: #666; margin-bottom: 1rem;">You haven't placed any orders yet.</p>
                    <a href="{{ route('home') }}" style="display: inline-block; background-color: var(--color-dark-blue-2); color: white; padding: 0.75rem 1.5rem; border-radius: 4px; text-decoration: none;">Start Shopping</a>
                </div>
            @else
                @foreach($orders as $order)
                    <div style="border: 1px solid #eee; border-radius: 4px; padding: 1rem; margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <div>
                                <h3 style="margin: 0;">Order #{{ $order->id }}</h3>
                                <p style="color: #666; margin: 0.25rem 0;">{{ $order->created_at->format('F j, Y') }}</p>
                            </div>
                            <div>
                                <span style="background-color: #e3f2fd; color: var(--color-dark-blue-2); padding: 0.25rem 0.5rem; border-radius: 4px;">{{ $order->status }}</span>
                            </div>
                        </div>
                        
                        <div style="margin-top: 1rem;">
                            <p style="margin: 0;"><strong>Total:</strong> RM{{ number_format($order->total, 2) }}</p>
                        </div>
                        
                        <div style="margin-top: 1rem;">
                            <a href="#" style="color: var(--color-dark-blue-2); text-decoration: none;">View Details →</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection