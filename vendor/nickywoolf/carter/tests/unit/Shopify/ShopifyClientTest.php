<?php

use GuzzleHttp\Client;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\ShopifyClient;

class ShopifyClientTest extends TestCase
{
    /** @test */
    function it_makes_get_request_to_store_endpoint()
    {
        $httpClient = Mockery::mock(Client::class);

        $client = new ShopifyClient($httpClient);

        $request = new ApiRequest('foo.bar', [
            'path'  => 'products.json',
            'query' => ['fields' => 'id,title'],
        ]);

        $httpClient->shouldReceive('get')
            ->with('https://foo.bar/admin/products.json?fields=id,title', [])
            ->once();

        $client->get($request);
    }

    /** @test */
    function it_makes_post_request_to_store_endpoint()
    {
        $httpClient = Mockery::mock(Client::class);

        $client = new ShopifyClient($httpClient);

        $request = new ApiRequest('foo.bar', [
            'path'    => 'products.json',
            'json' => ['product' => ['title' => 'thing one']],
        ]);

        $httpClient->shouldReceive('post')->with('https://foo.bar/admin/products.json', [
            'json' => [
                'product' => ['title' => 'thing one']
            ]
        ])->once();

        $client->post($request);
    }

    /** @test */
    function it_returns_a_response()
    {
        $httpClient = Mockery::mock(Client::class);

        $client = new ShopifyClient($httpClient);

        $request = new ApiRequest('foo.bar', [
            'path'  => 'products.json',
            'query' => ['fields' => 'id,title'],
        ]);

        $httpClient->shouldReceive('get')
            ->with('https://foo.bar/admin/products.json?fields=id,title', [])
            ->once()->andReturn('A Response');

        $this->assertEquals('A Response', $client->get($request));
    }
}