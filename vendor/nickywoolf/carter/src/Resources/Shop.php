<?php

namespace NickyWoolf\Carter\Resources;

class Shop extends Resource
{
    public function get($query = '')
    {
        $response = $this->client->get("shop.json{$query}");

        return $response['shop'];
    }
}