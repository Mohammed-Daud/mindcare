<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Don't redirect if already on a login route
        if ($request->is('client/login') || 
            $request->is('admin/login') || 
            $request->is('professional/login') || 
            $request->is('login')) {
            return null;
        }

        // Check which guard is being used and redirect accordingly
        if ($request->is('client/*')) {
            return route('client.login');
        } elseif ($request->is('admin/*')) {
            return route('admin.login');
        } elseif ($request->is('professional/*')) {
            return route('professional.login');
        }

        return route('login');
    }
}
