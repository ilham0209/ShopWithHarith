@extends('layouts.frontend')

@section('title', 'Register')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <div style="max-width: 450px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px;">
        <h1 style="text-align: center; margin-bottom: 2rem;">Register</h1>
        
        @if ($errors->any())
            <div style="color: red; margin-bottom: 1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Token will be managed by both Blade and JavaScript -->
            
            <div style="margin-bottom: 1rem;">
                <label for="name">Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 4px;">
                @error('name')
                    <span style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="email">Email Address</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 4px;">
                @error('email')
                    <span style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="password">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 4px;">
                @error('password')
                    <span style="color: #dc3545; font-size: 0.875rem; display: block; margin-top: 0.25rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 4px;">
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>

        <div style="text-align: center; margin-top: 1rem;">
            <p>Already have an account? <a href="{{ route('login') }}" style="color: #3b82f6;">Login here</a></p>
        </div>
    </div>
</div>

<style>
.submit-btn {
    width: 100%;
    background-color: #3b82f6;
    color: white;
    padding: 0.75rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
}
.submit-btn:hover {
    background-color: #2563eb;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure CSRF token is present
    var token = "{{ csrf_token() }}";
    var form = document.getElementById('registerForm');
    
    form.addEventListener('submit', function(e) {
        // Check if token input exists
        var tokenInput = form.querySelector('input[name="_token"]');
        if (!tokenInput) {
            // If no token input exists, create and add one
            tokenInput = document.createElement('input');
            tokenInput.setAttribute('type', 'hidden');
            tokenInput.setAttribute('name', '_token');
            tokenInput.setAttribute('value', token);
            form.appendChild(tokenInput);
        } else {
            // If token exists but might be incorrect, update it
            tokenInput.value = token;
        }
    });
});
</script>
@endsection