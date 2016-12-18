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

        $clientId = config('carter.shopify.client_id');
        $scopes = implode(',', config('carter.shopify.scopes'));
        $state = session('state');

        $oauth = app(NickyWoolf\Carter\Shopify\Oauth::class);

        return $oauth->authorizationUrl($clientId, $scopes, $returnUrl, $state);

    }
}
