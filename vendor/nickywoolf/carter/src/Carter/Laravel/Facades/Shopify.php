<?php

namespace NickyWoolf\Carter\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Shopify extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'shopify';
    }
}