<?php

namespace NickyWoolf\Carter\Shopify;

use InvalidArgumentException;

class ApiRequest
{
    /**
     * @var string
     */
    protected $domain;

    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var array
     */
    protected $allowedMethods = ['get', 'put', 'post', 'patch', 'delete'];

    /**
     * Request constructor.
     * @param string $domain
     * @param array $args
     */
    public function __construct($domain, $args = [])
    {
        $this->domain = $domain;
        $this->args = $args;
    }

    /**
     * @return string
     */
    public function domain()
    {
        return $this->domain;
    }

    /**
     * @param string $method
     * @return ApiRequest
     */
    public function setMethod($method)
    {
        $method = strtolower($method);

        if (! in_array($method, $this->allowedMethods)) {
            throw new InvalidArgumentException("HTTP method ['{$method}'] is not allowed");
        }

        return $this->mergeArgs(['method' => $method]);
    }

    /**
     * @return false|string
     */
    public function method()
    {
        return $this->pluck('method');
    }

    /**
     * @param string $accessToken
     * @return ApiRequest
     */
    public function setAccessToken($accessToken)
    {
        return $this->mergeArgs(['access_token' => $accessToken]);
    }

    /**
     * @return false|string
     */
    public function accessToken()
    {
        return $this->pluck('access_token');
    }

    /**
     * @param array $json
     * @return ApiRequest
     */
    public function setJson($json)
    {
        return $this->mergeArgs(['json' => $json]);
    }

    /**
     * @return array
     */
    public function options()
    {
        $options = [];

        if ($json = $this->pluck('json')) {
            $options['json'] = $json;
        }

        if ($accessToken = $this->pluck('access_token')) {
            $options['headers'] = ['X-Shopify-Access-Token' => $accessToken];
        }

        return $options;
    }

    /**
     * @param string $path
     * @return ApiRequest
     */
    public function setPath($path)
    {
        return $this->mergeArgs(['path' => $path]);
    }

    /**
     * @param string $query
     * @return ApiRequest
     */
    public function setQuery($query)
    {
        return $this->mergeArgs(['query' => $query]);
    }

    /**
     * @return string
     */
    public function endpoint()
    {
        $url = 'https://'.$this->domain().'/admin/'.trim($this->pluck('path'), '/');

        if (! $query = $this->pluck('query')) {
            return $url;
        }

        return $url.'?'.urldecode(http_build_query($query, '', '&'));
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function pluck($key, $default = false)
    {
        return isset($this->args[$key]) ? $this->args[$key] : $default;
    }

    /**
     * @param array $new
     * @return static
     */
    protected function mergeArgs($new)
    {
        return new static($this->domain(), array_merge($this->args, $new));
    }
}