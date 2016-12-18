<?php

namespace NickyWoolf\Carter;

interface ApiCallsStore
{
    /**
     * @param string $domain
     * @param CallLimit $limit
     * @return void
     */
    public function put($domain, CallLimit $limit);

    /**
     * @param string $domain
     * @return CallLimit
     */
    public function get($domain);
}