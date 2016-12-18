<?php

namespace NickyWoolf\Carter\Shopify\Api;

use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\Shopify\ApiRequest;
use NickyWoolf\Carter\Shopify\Contracts\ShopifyClient as ShopifyClientContract;
use NickyWoolf\Carter\Shopify\ShopifyClient;

abstract class Resource
{
    /**
     * @var ApiRequest
     */
    protected $request;

    /**
     * @var ShopifyClient
     */
    protected $client;

    /**
     * @var int
     */
    protected $recordsPerPage = 250;

    public function __construct(ApiRequest $request, ShopifyClientContract $client = null)
    {
        $this->request = $request;
        $this->client = $client ?: new ShopifyClient();
    }

    /**
     * @param Response $response
     * @param bool|string $extract
     * @return mixed
     */
    public function parse(Response $response, $extract = false)
    {
        $body = json_decode($response->getBody(), true);

        return $extract ? $body[$extract] : $body;
    }

    /**
     * @return bool|int
     */
    public function pages()
    {
        if (! method_exists($this, 'count')) {
            return false;
        }

        return (int) ceil($this->count() / (float) $this->recordsPerPage);
    }
}
