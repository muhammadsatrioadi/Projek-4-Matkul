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

        // Store the intended URL in the session
        $request->session()->put('url.intended', $request->url());
        
        // Clear any existing authentication data
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return route('user.login');
    }
}
