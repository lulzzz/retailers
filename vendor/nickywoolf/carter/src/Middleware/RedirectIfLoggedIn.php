<?php

namespace NickyWoolf\Carter\Middleware;

use Closure;

class RedirectIfLoggedIn
{
    public function handle($request, Closure $next)
    {
        if (auth()->guest()) {
            return $next($request);
        }

        return redirect()->route('carter.dashboard');
    }
}
