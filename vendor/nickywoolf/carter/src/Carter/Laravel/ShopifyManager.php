<?php

namespace NickyWoolf\Carter\Laravel;

use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\Client;
use NickyWoolf\Carter\Shopify\Oauth;
use phpDocumentor\Reflection\Types\Resource;

class ShopifyManager
{
    protected $auth;

    protected $request;

    /**
     * ShopifyManager constructor.
     * @param Guard $auth
     * @param Request $request
     */
    public function __construct(Guard $auth, Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;
    }

    /**
     * @param $resource
     * @return Resource
     * @throws Exception
     */
    public function resource($resource)
    {
        $fullyQualified = "\\NickyWoolf\\Carter\\Shopify\\Api\\{$resource}";

        if (! class_exists($fullyQualified)) {
            throw new Exception("Shopify API class ['{$fullyQualified}'] does not exist");
        }

        return $this->resolve($fullyQualified);
    }

    /**
     * @return Oauth
     */
    public function oauth()
    {
        return $this->resolve(Oauth::class);
    }

    /**
     * @return ApiRequest
     */
    public function apiRequest()
    {
        $domain = ($user = $this->auth->user()) ? $user->domain : $this->request->get('shop');

        return new ApiRequest($domain, $user ? ['access_token' => $user->access_token] : []);
    }

    /**
     * @param $class
     * @return Oauth|Resource
     */
    protected function resolve($class)
    {
        return app($class);
    }
}