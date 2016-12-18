<?php

use NickyWoolf\Carter\Oauth;
use NickyWoolf\Carter\ShopifyApiClient;

class OauthTest extends TestCase
{
    /** @test */
    function it_returns_the_authorization_url()
    {
        $oauth = new Oauth(new ShopifyApiClient('shopify-domain'));

        $url = implode([
            'https://shopify-domain/admin/oauth/authorize?',
            'client_id=CLIENT_ID&',
            'scope=SCOPE&',
            'redirect_uri=REDIRECT&',
            'state=STATE'
        ]);

        $this->assertEquals($url, $oauth->authorize('CLIENT_ID', 'SCOPE', 'REDIRECT', 'STATE'));
    }
}