<?php

namespace NickyWoolf\Carter\Shopify\Api;

class Shop extends Resource
{
    public function get($query = false)
    {
        $request = $this->request->setPath('shop.json')->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'shop');
    }
}