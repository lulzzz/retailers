<?php

namespace NickyWoolf\Carter\Shopify\Api;

class Product extends Resource
{
    public function all($query = false)
    {
        $request = $this->request->setPath('products.json')->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'products');
    }

    public function get($id, $query = false)
    {
        $request = $this->request->setPath("products/{$id}.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'product');
    }

    public function count($query = [])
    {
        $request = $this->request->setPath('products/count.json')->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'count');
    }

    public function create(array $product)
    {
        $request = $this->request->setPath('products.json')->setJson(['product' => $product]);

        $response = $this->client->post($request);

        return $this->parse($response, 'product');
    }

    public function update($id, array $product)
    {
        $request = $this->request->setPath("products/{$id}.json")->setJson(['product' => $product]);

        $response = $this->client->put($request);

        return $this->parse($response, 'product');
    }

    public function delete($id)
    {
        $request = $this->request->setPath("products/{$id}.json");

        return $this->client->delete($request)->getStatusCode();
    }
}