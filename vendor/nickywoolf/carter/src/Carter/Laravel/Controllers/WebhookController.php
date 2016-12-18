<?php

namespace NickyWoolf\Carter\Laravel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->middleware(['bindings', 'throttle:60', 'carter.webhook']);
    }

    public function uninstall()
    {
        $shop = $this->request->header('X-Shopify-Shop-Domain');

        app('carter.user')->forShop($shop)->uninstall();
    }
}