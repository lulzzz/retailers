<?php

namespace NickyWoolf\Carter\Middleware;

use Closure;

class HasShopifyDomain
{
    public function handle($request, Closure $next)
    {
        if ($request->has('shop')) {
            return $next($request);
        }
        
        if (auth()->check()) {
             return redirect()->route('carter.login', $request->all());
        }

        return redirect()->route('carter.signup')
            ->withErrors('Shopify store domain required');
    }
}
