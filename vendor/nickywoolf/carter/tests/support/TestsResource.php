<?php

use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\ShopifyClient;

trait TestsResource
{
    protected $expectedEndpoint;

    protected $expectedOptions;

    protected function createExpectingClient($method, $response)
    {
        return Mockery::mock(ShopifyClient::class)
            ->shouldReceive($method)
            ->with($this->expectedRequest())
            ->andReturn($this->respond($response))
            ->getMock();
    }

    protected function expectEndpoint($endpoint)
    {
        $this->expectedEndpoint = $endpoint;

        return $this;
    }

    protected function expectOptions($options)
    {
        $this->expectedOptions = $options;

        return $this;
    }

    protected function expectedRequest()
    {
        return Mockery::on(function (ApiRequest $request) {
            return $request->endpoint() == $this->expectedEndpoint && $request->options() == $this->expectedOptions;
        });
    }

    protected function respond($body = [], $code = 200, $headers = [])
    {
        return new Response($code, $headers, json_encode($body));
    }
}