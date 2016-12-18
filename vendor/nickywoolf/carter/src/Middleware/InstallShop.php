<?php

namespace NickyWoolf\Carter\Middleware;

use Closure;

class InstallShop
{
    public function handle($request, Closure $next)
    {

        if ($request->get('shop')) {
            return redirect()->route('carter.install', $request->all());
        }

        return redirect()->route('carter.expired');
    }
}
