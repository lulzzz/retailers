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

        if ($request->headers->get('referer') == app('carter.app_store_url')) {

            return redirect()->route('carter.install', $request->all());
            
        } else {

            if ($request->get('shop')) {
                return redirect()->route('carter.login', $request->all());
            }

        }


        return redirect()->route('carter.expired');
    }
}
