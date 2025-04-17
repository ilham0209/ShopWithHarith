<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        // Add debug information
        Log::info('Showing registration form', [
            'session_id' => session()->getId(),
            'has_token' => session()->has('_token'),
            'token' => session()->token()
        ]);
        
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Log the request for debugging
        Log::info('Registration attempt', [
            'session_id' => session()->getId(),
            'has_token' => session()->has('_token'),
            'session_token' => session()->token(),
            'request_token' => $request->input('_token'),
            'token_match' => $request->input('_token') === session()->token(),
            'method' => $request->method(),
            'route' => $request->route()->getName(),
            'inputs' => $request->except(['password', 'password_confirmation'])
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Log successful registration
        Log::info('Registration successful', [
            'user_id' => $user->id,
            'session_id' => session()->getId()
        ]);

        // Login the user
        auth()->login($user);
        
        // Regenerate the session for security
        $request->session()->regenerate();

        return redirect('/');
    }
}