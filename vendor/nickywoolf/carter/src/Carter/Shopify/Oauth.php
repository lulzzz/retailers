<?php

namespace NickyWoolf\Carter\Shopify;

use NickyWoolf\Carter\Shopify\Contracts\ShopifyClient as ShopifyClientContract;

class Oauth
{
    protected $request;

    protected $client;

    public function __construct(ApiRequest $request, ShopifyClientContract $client = null)
    {
        $this->request = $request;
        $this->client = $client ?: new ShopifyClient();
    }

    /**
     * @param string $clientId
     * @param string $scope
     * @param string $redirectUri
     * @param string $state
     * @return string
     */
    public function authorizationUrl($clientId, $scope, $redirectUri, $state)
    {
        return $this->request->setPath('oauth/authorize')->setQuery([
            'client_id'    => $clientId,
            'scope'        => $scope,
            'redirect_uri' => $redirectUri,
            'state'        => $state
        ])->endpoint();
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     * @return string
     */
    public function requestAccessToken($clientId, $clientSecret, $code)
    {
        $request = $this->request->setPath('oauth/access_token')->setJson([
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'code'          => $code
        ]);

        $response = json_decode($this->client->post($request)->getBody(), true);

        return $response['access_token'];
    }
}
