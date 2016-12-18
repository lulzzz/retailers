<?php

use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\ApiCallsArray;
use NickyWoolf\Carter\ApiCallsCollection;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\CallLimit\CallQueueCollection;
use NickyWoolf\Carter\Shopify\CallLimit\CallQueueStorageArray;

class ApiCallsCollectionTest extends TestCase
{
    /**
     * @var ApiCallsCollection
     */
    protected $collection;

    public function setUp()
    {
        ApiCallsArray::clear();

        $this->collection = $this->collection();
    }

    protected function collection()
    {
        return new ApiCallsCollection(new ApiCallsArray());
    }

    protected function response($calls)
    {
        return new Response(200, ['X-Shopify-Shop-Api-Call-Limit' => "{$calls}/40"]);
    }

    /** @test */
    function it_returns_new_queue_for_new_domain()
    {
        $this->assertEquals(0, $this->collection->requestCount('shopify-domain'));
    }

    /** @test */
    function it_updates_an_existing_domain()
    {
        $this->collection->addRequest('shopify-domain');
        $this->collection->addRequest('shopify-domain');

        $this->assertEquals(2, $this->collection->requestCount('shopify-domain'));
    }

    /** @test */
    function it_returns_time_to_wait_before_sending_request()
    {
        $this->collection->handleResponse('shopify-domain', $this->response(39));

        $this->collection->addRequest('shopify-domain');
        $this->collection->addRequest('shopify-domain');

        $this->assertEquals(1.0, $this->collection->waitTime('shopify-domain'));
    }

    /** @test */
    function it_remembers_call_count_with_different_instances()
    {
        $this->collection->addRequest('shopify-domain');
        $this->collection->addRequest('shopify-domain');

        $this->assertEquals(2, $this->collection()->requestCount('shopify-domain'));
    }
}