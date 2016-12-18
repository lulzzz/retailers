<?php

use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\CallLimit\CallQueueCollection;
use NickyWoolf\Carter\Shopify\CallLimit\CallQueueStorageArray;

class CallQueueCollectionTest extends TestCase
{
    protected $collection;

    public function setUp()
    {
        $this->collection = $this->collection();
    }

    protected function collection()
    {
        return new CallQueueCollection(new CallQueueStorageArray());
    }

    protected function request($domain)
    {
        return new ApiRequest($domain);
    }

    protected function response($calls)
    {
        return new Response(200, ['X-Shopify-Shop-Api-Call-Limit' => "{$calls}/40"]);
    }

    /** @test */
    function it_returns_new_queue_for_new_domain()
    {
        $this->assertEquals(0, $this->collection->count($this->request('foo')));
    }

    /** @test */
    function it_updates_an_existing_domain()
    {
        $request = $this->request('bar');

        $this->collection->enqueue($request);
        $this->collection->enqueue($request);

        $this->assertEquals(2, $this->collection->count($request));
    }

    /** @test */
    function it_returns_time_to_wait_before_sending_request()
    {
        $request = $this->request('baz');

        $this->collection->dequeue($request, $this->response(39));

        $this->collection->enqueue($request);
        $wait = $this->collection->enqueue($request);

        $this->assertEquals(1.0, $wait);
    }

    /** @test */
    function it_remembers_call_count_with_different_instances()
    {
        $request = $this->request('qux');

        $this->collection->enqueue($request);
        $this->collection->enqueue($request);

        $this->assertEquals(2, $this->collection()->count($request));
    }
}