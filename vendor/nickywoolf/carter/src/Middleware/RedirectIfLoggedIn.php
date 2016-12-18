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


        if (auth()->check()) {
            return redirect()->route('carter.login', $request->all());
        }

        return redirect()->route('carter.dashboard');
    }
}
