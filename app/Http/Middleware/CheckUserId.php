<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserId
{
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('CheckUserId middleware running', [
            'user_id' => auth()->id(),
            'is_authenticated' => auth()->check(),
            'path' => $request->path(),
            'session_id' => session()->getId()
        ]);

        if (!auth()->check()) {
            \Log::warning('User not authenticated');
            return redirect()->route('login');
        }

        if (auth()->id() !== 1) {
            \Log::warning('Unauthorized user', ['user_id' => auth()->id()]);
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}