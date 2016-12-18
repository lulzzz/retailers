<?php

use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\Shopify\CallLimit\CallQueue;

class CallQueueTest extends TestCase
{
    protected $queue;

    protected $request;

    public function setUp()
    {
        $this->queue = new CallQueue;
    }

    protected function response($calls)
    {
        return new Response(200, ['X-Shopify-Shop-Api-Call-Limit' => "{$calls}/40"]);
    }

    /** @test */
    function it_adds_request_to_call_queue()
    {
        $this->queue->enqueue();

        $this->assertEquals(1, $this->queue->count());
    }

    /** @test */
    function it_removes_request_from_call_queue()
    {
        $this->queue->enqueue();

        $this->queue->dequeue($this->response(39));

        $this->assertEquals(0, $this->queue->count());
    }

    /** @test */
    function it_suggests_wait_time_when_reaching_call_limit()
    {
        $this->queue->enqueue();

        $this->queue->dequeue($this->response(39));

        $this->assertEquals(0.5, $this->queue->enqueue());
    }

    /** @test */
    function it_adds_more_wait_time_for_more_queued_requests()
    {
        $this->queue->enqueue();

        $this->queue->dequeue($this->response(39));

        $this->assertEquals(0.5, $this->queue->enqueue());
        $this->assertEquals(1.0, $this->queue->enqueue());
        $this->assertEquals(1.5, $this->queue->enqueue());
    }

    /** @test */
    function it_adjusts_time_when_request_dequeued()
    {
        $this->queue->dequeue($this->response(40));

        $this->queue->enqueue();
        $this->queue->enqueue();
        $this->queue->enqueue();

        $this->assertEquals(2.0, $this->queue->enqueue());

        $this->queue->dequeue($this->response(40));
        $this->queue->dequeue($this->response(40));
        $this->queue->dequeue($this->response(40));

        $this->assertEquals(1.0, $this->queue->enqueue());
    }
}