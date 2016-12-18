<?php

namespace NickyWoolf\Carter\Shopify\CallLimit;

use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\Contracts\CallQueueStorage;
use NickyWoolf\Carter\Shopify\Contracts\ShopifyClient as ShopifyClientContract;

class ShopifyClientThrottle implements ShopifyClientContract
{
    /**
     * @var ShopifyClientContract
     */
    protected $client;

    /**
     * @var CallQueueCollection
     */
    protected $collection;

    /**
     * ShopifyClientThrottle constructor.
     * @param ShopifyClientContract $client
     * @param CallQueueCollection|null $collection
     */
    public function __construct(ShopifyClientContract $client, CallQueueCollection $collection = null)
    {
        $this->client = $client;
        $this->collection = $collection ?: new CallQueueCollection($this->makeCollectionStorage());
    }

    /**
     * @return CallQueueStorage
     */
    protected function makeCollectionStorage()
    {
        return new CallQueueStorageArray();
    }

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function send(ApiRequest $request)
    {
        $this->wait($this->collection->enqueue($request));

        $response = $this->client->send($request);

        return $this->collection->dequeue($request, $response);
    }

    /**
     * @param false|float $seconds
     */
    protected function wait($seconds)
    {
        usleep((float) $seconds * 1000000);
    }

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function get(ApiRequest $request)
    {
        return $this->send($request->setMethod('get'));
    }

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function put(ApiRequest $request)
    {
        return $this->send($request->setMethod('put'));
    }

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function post(ApiRequest $request)
    {
        return $this->send($request->setMethod('post'));
    }

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function patch(ApiRequest $request)
    {
        return $this->send($request->setMethod('patch'));
    }

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function delete(ApiRequest $request)
    {
        return $this->send($request->setMethod('delete'));
    }
}