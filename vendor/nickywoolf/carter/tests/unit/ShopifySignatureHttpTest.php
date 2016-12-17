<?php


use NickyWoolf\Carter\ShopifySignatureHttp as Signature;

class ShopifySignatureHttpTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_can_verify_signature_is_from_shopify()
    {
        $hmac = hash_hmac('sha256', 'timestamp=1234567890&shop=foo.bar.myshopify.com', 'client_secret');

        $request = [
            'signature' => 'will-be-removed-during-verification',
            'hmac'      => $hmac,
            'timestamp' => '1234567890',
            'shop'      => 'foo.bar.myshopify.com'
        ];

        $signature = new Signature($request);

        $this->assertTrue($signature->validHmac('client_secret'));
    }

    /** @test */
    function it_can_detect_an_invalid_signature()
    {
        $hmac = hash_hmac('sha256', 'timestamp=1234567890&shop=foo.bar.myshopify.com', 'some_different_secret');

        $request = [
            'signature' => 'will-be-removed-during-verification',
            'hmac'      => 'will-also-be-removed',
            'timestamp' => '1234567890',
            'shop'      => 'foo.bar.myshopify.com'
        ];

        $signature = new Signature($request);

        $this->assertFalse($signature->validHmac($hmac, 'client_secret'));
    }

    /** @test */
    function it_can_verify_shop_domain_pattern()
    {
        $request = ['shop' => 'foobar.myshopify.com'];

        $signature = new Signature($request);

        $this->assertTrue($signature->validHostname());
    }

    /** @test */
    function it_can_detect_an_invalid_shop_domain_pattern()
    {
        $request = ['shop' => 'foobar.example.com'];

        $signature = new Signature($request);

        $this->assertFalse($signature->validHostname());
    }

    /** @test */
    function it_can_verify_nonce()
    {
        $request = ['state' => '12345'];

        $signature = new Signature($request);

        $this->assertTrue($signature->validNonce('12345'));
    }

    /** @test */
    function it_can_detect_invalid_nonce()
    {
        $request = ['state' => '12345'];

        $signature = new Signature($request);

        $this->assertFalse($signature->validNonce('abcde'));
    }

    /** @test */
    function it_does_not_allow_empty_string_for_nonce_check()
    {
        $request = ['state' => ''];

        $signature = new Signature($request);

        $this->assertFalse($signature->validNonce(''));
    }

}