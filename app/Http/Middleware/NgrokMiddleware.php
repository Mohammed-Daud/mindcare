<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NgrokMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set the APP_URL to the ngrok URL if we're in local environment and using ngrok
        if (app()->environment('local') && str_contains($request->getHost(), 'ngrok-free.app')) {
            config(['app.url' => $request->getSchemeAndHttpHost()]);
        }

        return $next($request);
    }
} 