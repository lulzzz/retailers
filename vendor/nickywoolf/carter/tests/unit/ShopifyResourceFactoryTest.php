<?php

use NickyWoolf\Carter\Resources\Shop;
use NickyWoolf\Carter\ShopifyApiClient;
use NickyWoolf\Carter\ShopifyApiClientFactory;
use NickyWoolf\Carter\ShopifyResourceFactory;

class ShopifyResourceFactoryTest extends TestCase
{
    /** @test */
    function it_returns_a_shop_object()
    {
        $factory = new ShopifyResourceFactory(
            Mockery::mock(ShopifyApiClientFactory::class)
                ->shouldReceive('forDomainWithAccessToken')->with(null, null)
                ->andReturn(Mockery::mock(ShopifyApiClient::class))
                ->getMock()
        );

        $shop = $factory->resource('Shop');

        $this->assertInstanceOf(Shop::class, $shop);
    }

    /** @test */
    function it_throws_an_exception_when_resource_does_not_exist()
    {
        $factory = new ShopifyResourceFactory(Mockery::mock(ShopifyApiClientFactory::class));

        $this->setExpectedException(
            InvalidArgumentException::class,
            "Resource doesn't exist [\\NickyWoolf\\Carter\\Resources\\FooBar]"
        );

        $factory->resource('FooBar');
    }

    /** @test */
    function it_builds_client_with_provided_domain()
    {
        $factory = new ShopifyResourceFactory(new ShopifyApiClientFactory());

        $client = $factory->setDomain('shopify-domain')->client();

        $this->assertEquals('https://shopify-domain/admin/', $client->endpoint('/'));
    }
}