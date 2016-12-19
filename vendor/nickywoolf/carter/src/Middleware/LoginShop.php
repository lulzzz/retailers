<?php

namespace NickyWoolf\Carter\Middleware;

use Closure;

class LoginShop
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            return $next($request);
        }
        if ($request->headers->get('referer') == 'https://apps.shopify.com/locate-retailers') {
            return redirect()->route('carter.install', $request->all());
        } elseif ($request->get('shop')) {
            return redirect()->route('carter.login', $request->all());
        } else {
            return redirect()->route('carter.expired');
        }

    }
}
