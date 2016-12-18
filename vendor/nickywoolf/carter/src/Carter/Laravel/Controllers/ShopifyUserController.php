<?php

namespace NickyWoolf\Carter\Laravel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use NickyWoolf\Carter\Laravel\Facades\Shopify;
use NickyWoolf\Carter\Laravel\ShopifyUser;

class ShopifyUserController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->middleware('carter.guest');

        $this->middleware(['carter.domain', 'carter.signed'])->only('login');

        $this->middleware(['carter.domain', 'carter.install', 'carter.nonce'])->only('register');
    }

    public function register(ShopifyUser $user)
    {
        auth()->login($user->create());

        foreach (config('carter.shopify.webhooks') as $webhook) {
            Shopify::resource('Webhook')->create($webhook);
        }

        return redirect()->route('carter.plan.create', ['plan' => session('plan')]);
    }

    public function login()
    {
        $user = app('carter.user')->forShop($this->request->shop);

        auth()->login($user);

        return redirect()->route('carter.dashboard');
    }

    public function expired()
    {
        return view('carter::app.expired_session');
    }
}
