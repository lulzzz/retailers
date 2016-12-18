<?php

use NickyWoolf\Carter\Shopify\Api\ApplicationCharge;
use NickyWoolf\Carter\Shopify\ApiRequest;

class ApplicationChargeTest extends TestCase
{
    use TestsResource;

    /** @test */
    function it_makes_correct_request_for_all_charges()
    {
        $this->expectEndpoint(
            'https://store.domain/admin/application_charges.json?fields=id'
        )->expectOptions([
            'headers' => ['X-Shopify-Access-Token' => 'A Token']
        ]);

        $client = $this->createExpectingClient($method = 'get', $response = ['application_charges' => '']);

        $request = new ApiRequest('store.domain', ['access_token' => 'A Token']);
        $applicationCharge = new ApplicationCharge($request, $client);

        $applicationCharge->all(['fields' => 'id']);
    }

    /** @test */
    function it_returns_all_application_charges_for_shopify_store()
    {
        $this->expectEndpoint(
            'https://store.domain/admin/application_charges.json'
        )->expectOptions([
            'headers' => ['X-Shopify-Access-Token' => 'A Token']
        ]);

        $client = $this->createExpectingClient($method = 'get', $response = ['application_charges' => 'App Charges']);

        $request = new ApiRequest('store.domain', ['access_token' => 'A Token']);
        $applicationCharge = new ApplicationCharge($request, $client);

        $this->assertEquals('App Charges', $applicationCharge->all());
    }
}