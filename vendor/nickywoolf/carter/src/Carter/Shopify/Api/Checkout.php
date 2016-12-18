<?php

namespace NickyWoolf\Carter\Shopify\Api;

class Checkout extends Resource
{
    public function all()
    {
        $request = $this->request->setPath('checkouts.json');

        $response = $this->client->get($request);

        return $this->parse($response, 'checkouts');
    }

    public function count()
    {
        $request = $this->request->setPath('checkouts/count.json');

        $response = $this->client->get($request);

        return $this->parse($response, 'count');
    }
}