<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class CsrfDebug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Log the request details
        Log::info('Request Details', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'headers' => collect($request->headers->all())->only(['cookie', 'user-agent', 'accept', 'host'])->toArray(),
            'cookie_exists' => $request->hasCookie('laravel_session'),
            'cookies' => $request->cookies->all(),
        ]);

        // For POST, PUT, DELETE requests
        if (!in_array($request->method(), ['GET', 'HEAD'])) {
            Log::info('POST/PUT/DELETE Request Details', [
                'session_id' => session()->getId(),
                'session_token' => csrf_token(),
                'request_token' => $request->input('_token'),
                'token_match' => $request->input('_token') === csrf_token(),
            ]);
        }

        // Log details about the session
        Log::info('Session Details', [
            'session_id' => session()->getId(),
            'session_started' => session()->isStarted(),
            'session_has_token' => session()->has('_token'),
        ]);

        $response = $next($request);
        
        // Log info about the response
        Log::info('Response Details', [
            'status_code' => $response->getStatusCode(),
            'cookies' => method_exists($response, 'headers') ? 
                collect($response->headers->getCookies())->map(function($cookie) {
                    return [
                        'name' => $cookie->getName(),
                        'value' => substr($cookie->getValue(), 0, 10) . '...',
                        'domain' => $cookie->getDomain(),
                        'path' => $cookie->getPath(),
                        'secure' => $cookie->isSecure(),
                        'httpOnly' => $cookie->isHttpOnly(),
                    ];
                })->toArray() : 'No cookies in response',
        ]);
        
        return $response;
    }
}