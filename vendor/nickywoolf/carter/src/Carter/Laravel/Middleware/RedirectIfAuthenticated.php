<?php

namespace NickyWoolf\Carter\Laravel\Middleware;

use Closure;
use NickyWoolf\Carter\Shopify\Signature;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            return redirect()->route('carter.dashboard');
        }

        return $next($request);
    }
}