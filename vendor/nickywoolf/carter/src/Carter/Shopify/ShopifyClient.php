<?php

namespace NickyWoolf\Carter\Shopify;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\Shopify\Contracts\ShopifyClient as ShopifyClientContract;

class ShopifyClient implements ShopifyClientContract
{
    /**
     * @var null
     */
    protected $httpClient;

    /**
     * ShopifyClient constructor.
     * @param null $httpClient
     */
    public function __construct($httpClient = null)
    {
        $this->httpClient = $httpClient ?: new GuzzleClient();
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

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function send(ApiRequest $request)
    {
        return $this->httpClient->{$request->method()}($request->endpoint(), $request->options());
    }
}