<?php

namespace NickyWoolf\Carter\Laravel;

use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\Oauth;

class InstallApp
{
    protected $clientId;

    protected $scopes;

    protected $domain;

    protected $returnUrl;

    public function clientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function scopes($scopes)
    {
        $this->scopes = $scopes;

        return $this;
    }

    public function shopifyDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    public function returnUrl($url)
    {
        $this->returnUrl = $url;

        return $this;
    }

    public function state($state)
    {
        session(compact('state'));

        return $this;
    }

    public function plan($id)
    {
        session(['plan' => $id]);

        return $this;
    }

    public function authUrl()
    {
        $oauth = new Oauth(new ApiRequest($this->domain));

        return $oauth->authorizationUrl($this->clientId, $this->scopes, $this->returnUrl, session('state'));
    }
}