@extends('layouts.frontend')

@section('title', 'My Account')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <h1 style="margin-bottom: 2rem;">My Account</h1>
    
    <div style="display: grid; grid-template-columns: 1fr 3fr; gap: 2rem;">
        <!-- Navigation -->
        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="margin-bottom: 1.5rem;">
                <h3 style="margin-bottom: 0.5rem;">{{ $user->name }}</h3>
                <p style="color: #666;">{{ $user->email }}</p>
            </div>
            
            <nav>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 0.75rem;">
                        <a href="{{ route('account.index') }}" style="display: block; padding: 0.5rem; background-color: var(--color-blue-1); color: white; border-radius: 4px;">Dashboard</a>
                    </li>
                    <li style="margin-bottom: 0.75rem;">
                        <a href="{{ route('account.profile') }}" style="display: block; padding: 0.5rem; color: var(--color-dark-blue-2); background-color: #f5f5f5; border-radius: 4px;">Profile Settings</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Content -->
        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h2>Welcome back, {{ $user->name }}!</h2>
            <p>This is your account dashboard where you can view your profile and manage your account settings.</p>
        </div>
    </div>
</div>
@endsection