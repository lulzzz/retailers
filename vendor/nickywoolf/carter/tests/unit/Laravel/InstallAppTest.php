<?php

namespace NickyWoolf\Carter\Laravel;

use Mockery;
use TestCase;

class InstallAppTest extends TestCase
{
    public static $session;

    public function setUp()
    {
        parent::setUp();
        static::$session = Mockery::mock('session');
    }

    /** @test */
    function it_stores_nonce()
    {
        $installApp = new InstallApp();

        static::$session->shouldReceive('mock')->with(['state' => 'a number used once'])->once();

        $installApp->state('a number used once');
    }

    /** @test */
    function it_stores_plan()
    {
        $installApp = new InstallApp();

        static::$session->shouldReceive('mock')->with(['plan' => 12345])->once();

        $installApp->plan(12345);
    }

    /** @test */
    function it_returns_the_authorization_url()
    {
        $installApp = new InstallApp();

        static::$session->shouldReceive('mock')->with(['state' => 'STATE'])->once();
        static::$session->shouldReceive('get')->with('state')->once()->andReturn('STATE');

        $url = $installApp->shopifyDomain('domain.myshopify.com')
            ->scopes('read_products,write_products')
            ->returnUrl('https://localhost/register')
            ->clientId('client_id')
            ->state('STATE')
            ->authUrl();

        $this->assertEquals(
            'https://domain.myshopify.com/admin/oauth/authorize?client_id=client_id&scope=read_products,write_products&redirect_uri=https://localhost/register&state=STATE',
            $url
        );
    }
}

function session($key = null)
{
    if (is_array($key)) {
        return InstallAppTest::$session->mock($key);
    }

    return InstallAppTest::$session->get($key);
}

