<?php

namespace NickyWoolf\Carter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhooksController extends Controller
{
    public function __construct()
    {
        $this->middleware(['bindings', 'throttle:60', 'carter.webhook_signed']);
    }

    public function uninstall(Request $request)
    {
        app('carter.user')->forShop($request->header('X-Shopify-Shop-Domain'))->uninstall();
    }
}