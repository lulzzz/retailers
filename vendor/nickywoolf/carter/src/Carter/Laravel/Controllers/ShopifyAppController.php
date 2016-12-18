<?php

namespace NickyWoolf\Carter\Laravel\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use NickyWoolf\Carter\Laravel\InstallApp;
use NickyWoolf\Carter\Laravel\ShopifyUser;
use NickyWoolf\Carter\Shopify\Api\Webhook;

class ShopifyAppController extends Controller
{
    use ValidatesRequests;

    protected $request;

    protected $rules = [
        'shop' => 'required|unique:users,domain|max:255'
    ];

    protected $messages = [
        'shop.unique' => 'Store has already been registered'
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->middleware('carter.guest');

        $this->middleware('carter.domain')->only('install');
    }

    public function showSignupForm()
    {
        return view('carter::auth.register', ['plans' => config('carter.shopify.plans')]);
    }

    public function install(Request $request, InstallApp $installApp)
    {
        $this->validate($request, $this->rules, $this->messages);

        $url = $installApp->shopifyDomain($request->shop)
            ->scopes(implode(',', config('carter.shopify.scopes')))
            ->clientId(config('carter.shopify.client_id'))
            ->returnUrl(route('carter.register'))
            ->plan($this->request->get('plan'))
            ->state(Str::random(40))
            ->authUrl();

            dd($url);

        return redirect($url)->route('carter.register');

    }
}
