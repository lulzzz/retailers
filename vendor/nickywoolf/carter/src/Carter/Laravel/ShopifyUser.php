<?php

namespace NickyWoolf\Carter\Laravel;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use NickyWoolf\Carter\Shopify\Api\Shop;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\Oauth;

class ShopifyUser
{
    protected $request;

    protected $oauth;

    protected $accessToken;

    protected $shopFields = ['id', 'name', 'email', 'myshopify_domain'];

    /**
     * ShopifyUser constructor.
     * @param Request $request
     * @param Oauth $oauth
     */
    public function __construct(Request $request, Oauth $oauth)
    {
        $this->request = $request;
        $this->oauth = $oauth;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $shop = $this->shop()->get($this->fields());

        return app('carter.user')->create([
            'shopify_id'   => $shop['id'],
            'name'         => $shop['name'],
            'email'        => $shop['email'],
            'domain'       => $shop['myshopify_domain'],
            'access_token' => $this->accessToken,
            'installed'    => true,
            'password'     => bcrypt($this->request->get('password', Str::random(20)))
        ]);
    }

    /**
     * @return Shop
     */
    public function shop()
    {
        return new Shop($this->apiRequest());
    }

    /**
     * @return ApiRequest
     */
    public function apiRequest()
    {
        $this->accessToken = $this->requestAccessToken();

        return new ApiRequest($this->request->get('shop'), ['access_token' => $this->accessToken]);
    }

    /**
     * @return array
     */
    public function fields()
    {
        return ['fields' => implode(',', $this->shopFields)];
    }

    /**
     * @return string
     */
    protected function requestAccessToken()
    {
        return $this->oauth->requestAccessToken(
            config('carter.shopify.client_id'),
            config('carter.shopify.client_secret'),
            $this->request->get('code')
        );
    }
}