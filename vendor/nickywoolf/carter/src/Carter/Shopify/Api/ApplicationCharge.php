<?php

namespace NickyWoolf\Carter\Shopify\Api;

class ApplicationCharge extends Resource
{
    public function all($query = false)
    {
        $request = $this->request->setPath('application_charges.json')->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'application_charges');
    }

    public function get($id, $query = false)
    {
        $request = $this->request->setPath("application_charges/{$id}.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'application_charge');
    }

    public function create($charge)
    {
        $request = $this->request->setPath('application_charges.json')->setJson([
            'application_charge' => $charge
        ]);

        $response = $this->client->get($request);

        return $this->parse($response, 'application_charge');
    }

    public function activate($id)
    {
        $request = $this->request->setPath("applicatin_charges/{$id}/activate.json");

        return $this->client->get($request)->getStatusCode();
    }
}