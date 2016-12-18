<?php

namespace NickyWoolf\Carter\Shopify\Api;

class RecurringApplicationCharge extends Resource
{
    public function all($query = false)
    {
        $request = $this->request->setPath('recurring_application_charges.json')->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'recurring_application_charges');
    }

    public function get($id, $query = false)
    {
        $request = $this->request->setPath("recurring_application_charges/{$id}.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'recurring_application_charge');
    }

    public function activate($id)
    {
        $request = $this->request->setPath("recurring_application_charges/{$id}/activate.json")
            ->setJson(['recurring_application_charge' => $id]);

        $response = $this->client->post($request);

        return $this->parse($response, 'recurring_application_charge');
    }

    public function create($plan)
    {
        $request = $this->request->setPath("recurring_application_charges.json")
            ->setJson(['recurring_application_charge' => $plan]);

        $response = $this->client->post($request);

        return $this->parse($response, 'recurring_application_charge');
    }

    public function isAccepted($id)
    {
        $charge = $this->get($id);

        return in_array($charge['status'], ['accepted', 'active']);
    }
}