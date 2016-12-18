<?php


use NickyWoolf\Carter\Shopify\ApiRequest;

class ApiRequestTest extends TestCase
{
    /** @test */
    function it_has_a_shopify_domain()
    {
        $request = new ApiRequest('foo.bar');

        $this->assertEquals('foo.bar', $request->domain());
    }

    /** @test */
    function it_has_an_access_token()
    {
        $request = new ApiRequest('foo.bar', ['access_token' => 'abcdefg']);

        $this->assertEquals('abcdefg', $request->accessToken());
    }

    /** @test */
    function it_returns_new_instance_when_setting_access_token()
    {
        $request = new ApiRequest('foo.bar');

        $new = $request->setAccessToken('abcdefg');

        $this->assertFalse($request->accessToken());
        $this->assertEquals('abcdefg', $new->accessToken());
    }

    /** @test */
    function it_can_build_a_url_for_an_api_endpoint()
    {
        $request = new ApiRequest('foo.bar', ['path' => 'baz.json']);

        $this->assertEquals('https://foo.bar/admin/baz.json', $request->endpoint());
    }

    /** @test */
    function it_returns_new_instance_when_setting_path()
    {
        $request = new ApiRequest('foo.bar', ['path' => 'baz.json']);
        $new = $request->setPath('qux.json');

        $this->assertEquals('https://foo.bar/admin/baz.json', $request->endpoint());
        $this->assertEquals('https://foo.bar/admin/qux.json', $new->endpoint());
    }

    /** @test */
    function it_adds_query_string_to_endpoint_url()
    {
        $request = new ApiRequest('foo.bar', [
            'path'  => 'baz.json',
            'query' => ['this' => 'that']
        ]);

        $this->assertEquals('https://foo.bar/admin/baz.json?this=that', $request->endpoint());
    }

    /** @test */
    function it_returns_new_instance_when_setting_query()
    {
        $request = new ApiRequest('foo.bar', [
            'path'  => 'baz.json',
            'query' => ['this' => 'that']
        ]);

        $new = $request->setQuery(['them' => 'those']);

        $this->assertEquals('https://foo.bar/admin/baz.json?this=that', $request->endpoint());
        $this->assertEquals('https://foo.bar/admin/baz.json?them=those', $new->endpoint());
    }

    /** @test */
    function it_returns_new_instance_when_setting_json()
    {
        $request = new ApiRequest('foo.bar', ['json' => ['foo' => 'bar']]);

        $new = $request->setJson(['baz' => 'qux']);

        $this->assertEquals(['json' => ['foo' => 'bar']], $request->options());
        $this->assertEquals(['json' => ['baz' => 'qux']], $new->options());
    }

    /** @test */
    function it_knows_which_http_method_to_use()
    {
        $request = new ApiRequest('foo.bar', ['method' => 'get']);

        $this->assertEquals('get', $request->method());
    }

    /** @test */
    function it_returns_new_instance_when_setting_method()
    {
        $request = new ApiRequest('foo.bar', ['method' => 'get']);

        $new = $request->setMethod('post');

        $this->assertEquals('get', $request->method());
        $this->assertEquals('post', $new->method());
    }

    /** @test */
    function it_restricts_http_methods()
    {
        $request = new ApiRequest('foo.bar');

        $request->setMethod('get');
        $request->setMethod('put');
        $request->setMethod('post');
        $request->setMethod('patch');
        $request->setMethod('delete');

        $this->setExpectedException(InvalidArgumentException::class);

        $request->setMethod('foo');
    }

    /** @test */
    function it_includes_a_shopify_header_if_there_is_an_access_token()
    {
        $request = new ApiRequest('foo.bar', ['access_token' => 'abcdefg']);

        $this->assertEquals(
            ['headers' => ['X-Shopify-Access-Token' => 'abcdefg']],
            $request->options()
        );
    }
}