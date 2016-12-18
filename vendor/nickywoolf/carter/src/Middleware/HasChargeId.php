<?php

namespace NickyWoolf\Carter\Middleware;

use Closure;

class HasChargeId
{
    public function handle($request, Closure $next)
    {
        if ($request->has('charge_id')) {
            return $next($request);
        }

        return redirect()->route('carter.signup')
            ->withErrors('Request missing application charge ID');
    }
}