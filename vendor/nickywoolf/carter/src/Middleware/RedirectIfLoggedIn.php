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

        if ($request->headers->get('referer') == app('carter.app_store_url')) {
            return redirect()->route('carter.install', $request->all());
        }

        return redirect()->route('carter.dashboard');
    }
}
