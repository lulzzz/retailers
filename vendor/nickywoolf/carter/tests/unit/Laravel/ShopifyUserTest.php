<?php

namespace NickyWoolf\Carter\Laravel;

use Illuminate\Http\Request;
use Mockery;
use NickyWoolf\Carter\Shopify\Oauth;
use TestCase;

class ShopifyUserTest extends TestCase
{
    /** @test */
    function it_creates_an_api_request_with_access_token()
    {
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('get')->with('shop')->once()->andReturn('foo.bar');
        $request->shouldReceive('get')->with('code')->once()->andReturn('code');

        $oauth = Mockery::mock(Oauth::class);
        $oauth->shouldReceive('requestAccessToken')
            ->with('client_id', 'client_secret', 'code')
            ->once()->andReturn('A Token');

        $shopifyUser = new ShopifyUser($request, $oauth);

        $apiRequest = $shopifyUser->apiRequest();

        $this->assertEquals('https://foo.bar/admin/', $apiRequest->endpoint());
        $this->assertEquals(['headers' => ['X-Shopify-Access-Token' => 'A Token']], $apiRequest->options());
    }

    /** @test */
    function it_requests_shop_fields_with_correct_format()
    {
        $shopifyUser = new ShopifyUser(Mockery::mock(Request::class), Mockery::mock(Oauth::class));

        $this->assertEquals(['fields' => 'id,name,email,myshopify_domain'], $shopifyUser->fields());
    }
}

function config($key)
{
    $parts = explode('.', $key);

    return array_pop($parts);
}
