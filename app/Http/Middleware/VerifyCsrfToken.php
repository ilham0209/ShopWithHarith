<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'login',
        'register',
        '/login',
        '/register'
    ];

    protected function tokensMatch($request)
    {
        $sessionToken = $request->session()->token();
        $requestToken = $request->input('_token');

        Log::info('CSRF Check', [
            'session_id' => session()->getId(),
            'session_token' => $sessionToken,
            'request_token' => $requestToken,
            'match' => hash_equals($sessionToken, $requestToken)
        ]);

        return parent::tokensMatch($request);
    }

    public function handle($request, Closure $next)
    {
        if ($request->method() === 'POST') {
            Log::info('CSRF Debug', [
                'session_id' => session()->getId(),
                'token_match' => $request->session()->token() === $request->input('_token'),
                'request_token' => $request->input('_token'),
                'session_token' => session()->token(),
                'request_headers' => $request->headers->all(),
                'cookies' => $request->cookies->all(),
            ]);
        }
        return parent::handle($request, $next);
    }
}