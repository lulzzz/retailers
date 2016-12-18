<?php

namespace NickyWoolf\Carter\Shopify\CallLimit;

use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\Contracts\CallQueueStorage;

class CallQueueCollection
{
    protected $queueStorage;

    /**
     * CallQueueCollection constructor.
     * @param CallQueueStorage $queueStorage
     */
    public function __construct(CallQueueStorage $queueStorage)
    {
        $this->queueStorage = $queueStorage;
    }

    /**
     * @param ApiRequest $request
     * @return int
     */
    public function count(ApiRequest $request)
    {
        return $this->queueStorage->get($request->domain())->count();
    }

    /**
     * @param ApiRequest $request
     * @return bool|float
     */
    public function enqueue(ApiRequest $request)
    {
        $queue = $this->queueStorage->get($request->domain());

        $wait = $queue->enqueue();

        $this->queueStorage->store($request->domain(), $queue);

        return $wait;
    }

    /**
     * @param ApiRequest $request
     * @param Response $response
     * @return Response
     */
    public function dequeue(ApiRequest $request, Response $response)
    {
        $queue = $this->queueStorage->get($request->domain());

        $queue->dequeue($response);

        $this->queueStorage->store($request->domain(), $queue);

        return $response;
    }
}