<?php

namespace NickyWoolf\Carter\Laravel\Middleware;

use Closure;
use NickyWoolf\Carter\Shopify\Api\RecurringApplicationCharge;

class CheckChargeAccepted
{

    protected $charge;

    public function __construct(RecurringApplicationCharge $charge)
    {
        $this->charge = $charge;
    }

    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (! $user->charge_id || ! $this->charge->isAccepted($user->charge_id)) {
            return redirect()->route('carter.plans');
        }

        return $next($request);
    }
}