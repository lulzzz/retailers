<?php

namespace NickyWoolf\Carter\Middleware;

use Closure;
use Url;

class LoginShop
{
    public function handle($request, Closure $next)
    {
        dd(URL::previous());
        if (auth()->check()) {
            return $next($request);
        }

        if ($request->get('shop')) {
            return redirect()->route('carter.login', $request->all());
        }

        return redirect()->route('carter.expired');
    }
}
