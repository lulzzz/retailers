<?php

namespace NickyWoolf\Carter\Shopify\CallLimit;

use GuzzleHttp\Psr7\Response;
use Mockery;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\Contracts\ShopifyClient;
use TestCase;

class ShopifyClientThrottleTest extends TestCase
{
    public static $waiting = [];

    public function setUp()
    {
        parent::setUp();
        static::$waiting = [];
    }

    protected function request($domain, $method = 'get')
    {
        return new ApiRequest($domain, $method);
    }

    protected function response($calls)
    {
        return new Response(200, ['X-Shopify-Shop-Api-Call-Limit' => "{$calls}/40"]);
    }

    /** @test */
    function is_waits_to_send_request_when_call_limit_reached()
    {
        $request = $this->request('foo.bar');
        $client = Mockery::mock(ShopifyClient::class);
        $client->shouldReceive('send')
            ->with($request)->twice()
            ->andReturn($this->response(39), $this->response(40));

        $throttle = new ShopifyClientThrottle($client);
        $throttle->send($request);
        $throttle->send($request);

        $this->assertEquals([0, 500000.0], static::$waiting);
    }

    /** @test */
    function it_does_not_wait_if_call_limit_has_not_been_reached()
    {
        $request = $this->request('bar.baz');
        $client = Mockery::mock(ShopifyClient::class);
        $client->shouldReceive('send')
            ->with($request)->times(5)
            ->andReturn($this->response(1));

        $throttle = new ShopifyClientThrottle($client);

        $throttle->send($request);
        $throttle->send($request);
        $throttle->send($request);
        $throttle->send($request);
        $throttle->send($request);

        $this->assertEquals([0, 0, 0, 0, 0], static::$waiting);
    }

    /** @test */
    function it_manages_queue_for_multiple_stores()
    {
        $bazQux = $this->request('baz.qux');
        $quxQuux = $this->request('qux.quux');
        $client = Mockery::mock(ShopifyClient::class);
        $client->shouldReceive('send')
            ->with($bazQux)->times(3)
            ->andReturn($this->response(1));
        $client->shouldReceive('send')
            ->with($quxQuux)->times(3)
            ->andReturn($this->response(40));

        $throttle = new ShopifyClientThrottle($client);

        $throttle->send($bazQux);
        $throttle->send($quxQuux);
        $throttle->send($bazQux);
        $throttle->send($quxQuux);
        $throttle->send($bazQux);
        $throttle->send($quxQuux);

        $this->assertEquals([0, 0, 0, 500000.0, 0, 500000.0], static::$waiting);
    }
}

function usleep($microseconds)
{
    ShopifyClientThrottleTest::$waiting[] = $microseconds;
}

