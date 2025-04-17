<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class SessionDebug
{
    public function handle($request, Closure $next)
    {
        Log::info('Session State', [
            'url' => $request->url(),
            'method' => $request->method(),
            'session_id' => session()->getId(),
            'has_session' => $request->hasSession(),
            'cookies' => $request->cookies->all()
        ]);

        return $next($request);
    }
}