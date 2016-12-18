<?php

namespace NickyWoolf\Carter\Laravel\Middleware;

use Closure;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (auth()->guest()) {
            if (!$request->get('shop')) {
                return redirect()->route('carter.expired');
            }

            return redirect()->route('carter.login', $request->all());
        }

        return $next($request);
    }
}
