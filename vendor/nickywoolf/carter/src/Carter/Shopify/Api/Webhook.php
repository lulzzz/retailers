<?php

namespace NickyWoolf\Carter\Shopify\Api;

class Webhook extends Resource
{
    public function all($query = false)
    {
        $request = $this->request->setPath('webhooks.json')->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'webhooks');
    }

    public function get($id, $query = false)
    {
        $request = $this->request->setPath("webhooks/{$id}.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'webhook');
    }

    public function count($query = false)
    {
        $request = $this->request->setPath("webhooks/count.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'count');
    }

    public function create(array $webhook)
    {
        if (! isset($webhook['format'])) {
            $webhook['format'] = 'json';
        }

        $request = $this->request->setPath('webhooks.json')->setJson(['webhook' => $webhook]);

        $response = $this->client->post($request);

        return $this->parse($response, 'webhook');
    }

    public function update($id, array $webhook)
    {
        $request = $this->request->setPath("webhooks/{$id}.json")->setJson(['webhook' => $webhook]);

        $response = $this->client->put($request);

        return $this->parse($response, 'webhook');
    }

    public function delete($id)
    {
        $request = $this->request->setPath("webhooks/{$id}.json");

        return $this->client->delete($request)->getStatusCode();
    }
}