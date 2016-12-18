<?php

namespace NickyWoolf\Carter\Shopify\CallLimit;

use GuzzleHttp\Psr7\Response;

class CallQueue
{
    protected $header = 'X-Shopify-Shop-Api-Call-Limit';

    protected $limit = 40;

    protected $wait = 0.5;

    protected $calls = 0;

    protected $requests = [];

    /**
     * @return bool|float
     */
    public function enqueue()
    {
        $this->requests[] = microtime();

        return $this->waitTime();
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function dequeue(Response $response)
    {
        $this->calls = $this->calls($response);

        array_shift($this->requests);

        return $response;
    }

    /**
     * @param Response $response
     * @return int
     */
    protected function calls(Response $response)
    {
        if (! $headers = $response->getHeader($this->header)) {
            return $this->calls;
        }

        list($calls) = array_map('intval', explode('/', $headers[0]));

        return $calls;
    }

    /**
     * @return bool|float
     */
    public function waitTime()
    {
        return $this->reachedCallLimit() ? $this->count() * $this->wait : false;
    }

    /**
     * @return bool
     */
    public function reachedCallLimit()
    {
        return $this->calls + $this->count() >= $this->limit;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->requests);
    }
}