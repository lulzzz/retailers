<?php

namespace NickyWoolf\Carter\Laravel;

use Illuminate\Contracts\Cache\Repository;
use NickyWoolf\Carter\Shopify\CallLimit\CallQueue;
use NickyWoolf\Carter\Shopify\Contracts\CallQueueStorage;

class CallQueueStorageCache implements CallQueueStorage
{
    protected $cache;

    /**
     * CallQueueStorageCache constructor.
     * @param Repository $cache
     */
    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $domain
     * @return CallQueue
     */
    public function get($domain)
    {
        return $this->cache->get($this->key($domain), $this->newQueue());
    }

    /**
     * @param string $domain
     * @param CallQueue $queue
     * @return void
     */
    public function store($domain, CallQueue $queue)
    {
        $this->cache->put($this->key($domain), $queue, 1);
    }

    /**
     * @param string $domain
     * @return string
     */
    protected function key($domain)
    {
        return "api.limit.{$domain}";
    }

    /**
     * @return CallQueue
     */
    protected function newQueue()
    {
        return new CallQueue();
    }
}