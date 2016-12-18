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

        if ($request->get('shop')) {
            return redirect()->route('carter.install', $request->all());
        }

        return redirect()->route('carter.dashboard');
    }
}
