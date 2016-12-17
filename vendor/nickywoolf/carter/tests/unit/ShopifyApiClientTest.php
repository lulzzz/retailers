<?php

use NickyWoolf\Carter\ShopifyApiClient;

class ShopifyApiClientTest extends TestCase
{
    /** @test */
    function it_removes_extra_slashes()
    {
        $client = new ShopifyApiClient('shopify-domain/');

        $this->assertEquals('https://shopify-domain/admin/products.json', $client->endpoint('/products.json/'));
    }
}

