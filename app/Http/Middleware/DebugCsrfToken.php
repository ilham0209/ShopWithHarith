<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class DebugCsrfToken
{
    public function handle($request, Closure $next)
    {
        Log::info('CSRF Debug', [
            'token_in_session' => session()->token(),
            'token_in_request' => $request->input('_token'),
            'session_id' => session()->getId(),
            'method' => $request->method(),
            'url' => $request->url()
        ]);

        return $next($request);
    }
}