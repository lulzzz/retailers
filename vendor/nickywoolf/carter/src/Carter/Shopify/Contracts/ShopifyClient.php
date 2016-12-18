<?php

namespace NickyWoolf\Carter\Shopify\Contracts;

use GuzzleHttp\Psr7\Response;
use NickyWoolf\Carter\Shopify\ApiRequest;

interface ShopifyClient
{
    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function get(ApiRequest $request);

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function put(ApiRequest $request);

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function post(ApiRequest $request);

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function patch(ApiRequest $request);

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function delete(ApiRequest $request);

    /**
     * @param ApiRequest $request
     * @return Response
     */
    public function send(ApiRequest $request);
}