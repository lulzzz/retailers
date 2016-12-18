<?php

namespace NickyWoolf\Carter\Shopify\CallLimit;

use NickyWoolf\Carter\Shopify\Contracts\CallQueueStorage;

class CallQueueStorageArray implements CallQueueStorage
{
    protected static $queues = [];

    /**
     * @param string $domain
     * @return CallQueue
     */
    public function get($domain)
    {
        return isset(static::$queues[$domain]) ? static::$queues[$domain] : $this->newQueue();
    }

    /**
     * @param string $domain
     * @param CallQueue $queue
     * @return void
     */
    public function store($domain, CallQueue $queue)
    {
        static::$queues[$domain] = $queue;
    }

    /**
     * @return CallQueue
     */
    protected function newQueue()
    {
        return new CallQueue();
    }
}