<?php

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use NickyWoolf\Carter\Laravel\Facades\Shopify;
use NickyWoolf\Carter\Laravel\ShopifyManager;
use NickyWoolf\Carter\Shopify\Api\Product;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\Oauth;

class ShopifyManagerTest extends TestCase
{
    /** @test */
    function it_returns_api_resource()
    {
        $this->assertInstanceOf(Product::class, ShopifyFacade::resource('Product'));
    }

    /** @test */
    function it_returns_an_oauth_object()
    {
        $this->assertInstanceOf(Oauth::class, ShopifyFacade::oauth());
    }

    /** @test */
    function it_returns_an_api_request_object()
    {
        $this->assertInstanceOf(ApiRequest::class, ShopifyFacade::apiRequest());
    }

    /** @test */
    function it_sets_api_request_up_for_success()
    {
        $request = ShopifyFacade::apiRequest();

        $this->assertEquals('https://foo.bar/admin/', $request->endpoint());
        $this->assertEquals(['headers' => ['X-Shopify-Access-Token' => 'A Token']], $request->options());
    }

    /** @test */
    function it_throws_exception_to_bad_resource_name()
    {
        $this->setExpectedException(
            Exception::class,
            "Shopify API class ['\\NickyWoolf\\Carter\\Shopify\\Api\\FooBar'] does not exist"
        );

        ShopifyFacade::resource('FooBar');
    }
}

class ShopifyFacade extends Shopify
{
    public static function getFacadeRoot()
    {
        $user = (object) [
            'domain'       => 'foo.bar',
            'access_token' => 'A Token',
        ];

        $auth = Mockery::mock(Guard::class)
            ->shouldReceive('user')
            ->andReturn($user)
            ->getMock();

        $request = Mockery::mock(Request::class);

        return new ShopifyManagerDouble($auth, $request);
    }
}

class ShopifyManagerDouble extends ShopifyManager
{
    protected function resolve($class)
    {
        return new $class($this->apiRequest());
    }
}
