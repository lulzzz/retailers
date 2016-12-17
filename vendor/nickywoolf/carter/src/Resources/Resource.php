<?php

namespace NickyWoolf\Carter\Resources;

use NickyWoolf\Carter\ApiClient;

class Resource
{
    protected $client;

    protected $recordsPerPage = 250;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function pages()
    {
        if (! method_exists($this, 'count')) {
            return false;
        }

        return (int) ceil($this->count() / (float) $this->recordsPerPage);
    }
}