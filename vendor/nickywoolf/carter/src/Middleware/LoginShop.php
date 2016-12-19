<?php

namespace NickyWoolf\Carter\Middleware;

use Closure;

class LoginShop
{
    public function handle($request, Closure $next)
    {
        dd($request->headers->get('referer'));
        if (auth()->check()) {
            return $next($request);
        }

        if ($request->get('shop')) {
            return redirect()->route('carter.login', $request->all());
        }

        return redirect()->route('carter.expired');
    }
}
