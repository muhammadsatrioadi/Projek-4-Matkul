<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectOldUrls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Redirect old payment-success URL to user dashboard
        if ($request->is('payment-success')) {
            return redirect()->route('user.dashboard')
                ->with('success', 'Your payment has been processed successfully.');
        }

        return $next($request);
    }
} 