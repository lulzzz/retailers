<?php

namespace NickyWoolf\Carter\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use NickyWoolf\Carter\ShopifyResourceFactory;
use NickyWoolf\Carter\ShopifySignatureHttp;

class RegisteredUsersController extends Controller
{
    use ValidatesRequests;

    protected $resourceFactory;

    protected $signature;

    protected $accessToken;

    protected $rules = [
        'state' => 'required',
        'hmac' => 'required',
        'code' => 'required',
    ];

    public function __construct(ShopifyResourceFactory $resourceFactory, ShopifySignatureHttp $signature)
    {
        $this->resourceFactory = $resourceFactory;
        $this->signature = $signature;
        $this->middleware('carter.shopify_domain');
    }

    public function create(Request $request)
    {
        if ($redirect = $this->verifySignature($request)) {
            return $redirect;
        }

        $this->resourceFactory->setDomain($request->get('shop'))->setAccessToken($this->accessToken());

        auth()->login($this->user($request));

        foreach (config('carter.shopify.webhooks') as $webhook) {
            $this->resourceFactory->resource('Webhook')->create($webhook);
        }

        if ($plan = session('plan')) {
            return redirect()->route('carter.plan.create', compact('plan'));
        }

        return redirect()->route('carter.dashboard');
    }

    protected function verifySignature(Request $request)
    {
        if ($this->getValidationFactory()->make($request->all(), $this->rules)->fails()) {
            return redirect()->route('carter.signup')->withErrors('Invalid request');
        }

        if (! $this->signature->validHmac($this->secret()) || ! $this->signature->validHostname()) {
            app()->abort(403, 'Client Error: 403 - Invalid Signature');
        }

        if (! $this->signature->validNonce($request->get('state'))) {
            app()->abort(403, 'Client Error: 403 - Invalid State');
        }
    }

    protected function secret()
    {
        return config('carter.shopify.client_secret');
    }

    protected function accessToken()
    {
        return $this->accessToken = $this->resourceFactory->oauth()->accessToken(
            config('carter.shopify.client_id'), $this->secret(), request('code')
        );
    }

    protected function user(Request $request)
    {
        $shop = $this->resourceFactory->resource('Shop')->get();

        return app('carter.user')->create([
            'shopify_id' => $shop['id'],
            'name' => $shop['name'],
            'email' => $shop['email'],
            'domain' => $shop['myshopify_domain'],
            'access_token' => $this->accessToken,
            'installed' => true,
            'password' => bcrypt($request->get('password', Str::random(20))),
        ]);
    }
}
