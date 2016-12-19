<?php

namespace NickyWoolf\Carter\Middleware;

use Closure;

class LoginShop
{
    public function handle($request, Closure $next)
    {
        if ($request->headers->get('referer') == 'https://apps.shopify.com/locate-retailers') {
            return redirect()->route('carter.install', $request->all());
        }

        if (auth()->check()) {
            return $next($request);
        }

        if ($request->get('shop')) {
            return redirect()->route('carter.login', $request->all());
        }

        return redirect()->route('carter.expired');
    }
}
