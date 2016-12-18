<?php

namespace NickyWoolf\Carter\Shopify\Api;

class Asset extends Resource
{
    public function all($theme, $query = false)
    {
        $request = $this->request->setPath("themes/{$theme}/assets.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'assets');
    }

    public function get($theme, $id, $query = false)
    {
        $request = $this->request->setPath("themes/{$theme}/{$id}/assets.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'asset');
    }

    public function create($theme, array $asset)
    {
        return $this->update($theme, $asset);
    }

    public function update($theme, array $asset)
    {
        $request = $this->request->setPath("themes/{$theme}/assets.json")->setJson(['asset' => $asset]);

        $response = $this->client->put($request);

        return $this->parse($response, 'asset');
    }

    public function delete($theme, $id, array $query)
    {
        $request = $this->request->setPath("themes/{$theme}/{$id}/assets.json")->setQuery($query);

        return $this->client->delete($request)->getStatusCode();
    }
}