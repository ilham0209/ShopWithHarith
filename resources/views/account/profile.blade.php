@extends('layouts.frontend')

@section('title', 'Profile Settings')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <div style="display: grid; grid-template-columns: 1fr 3fr; gap: 2rem;">
        <!-- Navigation Sidebar -->
        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; flex-direction: column; justify-content: space-between;">
            <!-- Top Navigation Section -->
            <div>
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="margin-bottom: 0.5rem;">{{ $user->name }}</h3>
                    <p style="color: #666;">{{ $user->email }}</p>
                </div>
                
                <nav>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ route('account.index') }}" style="display: block; padding: 0.5rem; color: var(--color-dark-blue-2); background-color: #f5f5f5; border-radius: 4px;">Dashboard</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ route('account.profile') }}" style="display: block; padding: 0.5rem; background-color: var(--color-blue-1); color: white; border-radius: 4px;">Profile Settings</a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <!-- Logout Button at Bottom -->
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 0.75rem; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div>
            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 1rem; margin-bottom: 1rem; border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Profile Update Form -->
            <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem;">Update Profile</h2>
                <form action="{{ route('account.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="full_name" style="display: block; margin-bottom: 0.5rem;">Full Name</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->profile->full_name ?? '') }}" 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                        @error('full_name')
                            <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label for="phone" style="display: block; margin-bottom: 0.5rem;">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->profile->phone ?? '') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                        @error('phone')
                            <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label for="address" style="display: block; margin-bottom: 0.5rem;">Address</label>
                        <textarea id="address" name="address" style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px; min-height: 100px;">{{ old('address', $user->profile->address ?? '') }}</textarea>
                        @error('address')
                            <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" style="background-color: var(--color-blue-1); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer;">
                        Update Profile
                    </button>
                </form>
            </div>

            <!-- Delete Account Section -->
            <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h2 style="margin-bottom: 1.5rem; color: #dc3545;">Delete Account</h2>
                <p style="margin-bottom: 1rem; color: #666;">Once you delete your account, there is no going back. Please be certain.</p>
                
                <form action="{{ route('account.account.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display: block; margin-bottom: 0.5rem;">Confirm Password</label>
                        <input type="password" id="password" name="password" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;">
                        @error('password')
                            <span style="color: #dc3545; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" style="background-color: #dc3545; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer;">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection