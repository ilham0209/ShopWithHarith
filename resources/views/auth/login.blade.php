@extends('layouts.frontend')

@section('title', 'Login')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <div style="max-width: 450px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px;">
        <h1 style="text-align: center; margin-bottom: 2rem;">Loginy</h1>

        @if ($errors->any())
            <div style="background-color: #fee2e2; border: 1px solid #ef4444; padding: 1rem; margin-bottom: 1rem; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: #dc2626;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div style="margin-bottom: 1rem;">
                <label for="email" style="display: block; margin-bottom: 0.5rem;">Email Address</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 4px;">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="password" style="display: block; margin-bottom: 0.5rem;">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 4px;">
            </div>

            <button type="submit" class="submit-btn">Login</button>
        </form>

        <div style="text-align: center; margin-top: 1rem;">
            <p>Don't have an account? <a href="{{ route('register') }}" style="color: #3b82f6;">Register here</a></p>
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
.error {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}
</style>

<script>
// document.addEventListener('DOMContentLoaded', function() {
//     // Ensure CSRF token is present
//     var token = "{{ csrf_token() }}";
//     var form = document.getElementById('loginForm');
    
//     form.addEventListener('submit', function(e) {
//         // Check if token input exists
//         var tokenInput = form.querySelector('input[name="_token"]');
//         if (!tokenInput) {
//             // If no token input exists, create and add one
//             tokenInput = document.createElement('input');
//             tokenInput.setAttribute('type', 'hidden');
//             tokenInput.setAttribute('name', '_token');
//             tokenInput.setAttribute('value', token);
//             form.appendChild(tokenInput);
//         } else {
//             // If token exists but might be incorrect, update it
//             tokenInput.value = token;
//         }
//     });
// });
</script>
@endsection