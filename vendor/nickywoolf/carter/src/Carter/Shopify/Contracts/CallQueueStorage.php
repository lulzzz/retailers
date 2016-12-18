<?php

namespace NickyWoolf\Carter\Shopify\Contracts;

use NickyWoolf\Carter\Shopify\CallLimit\CallQueue;

interface CallQueueStorage
{
    /**
     * @param string $domain
     * @return CallQueue
     */
    public function get($domain);

    /**
     * @param string $domain
     * @param CallQueue $queue
     * @return void
     */
    public function store($domain, CallQueue $queue);
}