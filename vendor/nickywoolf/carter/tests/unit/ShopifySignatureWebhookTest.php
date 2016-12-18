<?php

use NickyWoolf\Carter\ShopifySignatureWebhook as Signature;

class ShopifySignatureWebhookTest extends TestCase
{
    /** @test */
    function it_can_validate_webhook_signature()
    {
        $header = 'y3AoiwEr8uvBsis6NSVbs4DJ9XSa/s4q88Tdk4QVF90=';
        $data = '{"id":15416853,"name":"Carter Development","email":"woolfnicky@gmail.com","domain":"carter-development.myshopify.com","created_at":"2016-10-12T07:36:20-07:00","province":"California","country":"US","address1":"3126 Barbados PL","zip":"92626","city":"Costa Mesa","source":"nicky-woolf","phone":"8157624236","updated_at":"2016-10-12T12:25:07-07:00","customer_email":null,"latitude":33.684308,"longitude":-117.928099,"primary_location_id":null,"primary_locale":"en","address2":null,"country_code":"US","country_name":"United States","currency":"USD","timezone":"(GMT-08:00) America\/Los_Angeles","iana_timezone":"America\/Los_Angeles","shop_owner":"Nicky Woolf","money_format":"${{amount}}","money_with_currency_format":"${{amount}} USD","province_code":"CA","taxes_included":false,"tax_shipping":null,"county_taxes":true,"plan_display_name":"affiliate","plan_name":"affiliate","has_discounts":false,"has_gift_cards":false,"myshopify_domain":"carter-development.myshopify.com","google_apps_domain":null,"google_apps_login_enabled":null,"money_in_emails_format":"${{amount}}","money_with_currency_in_emails_format":"${{amount}} USD","eligible_for_payments":true,"requires_extra_payments_agreement":false,"password_enabled":true,"has_storefront":true,"eligible_for_card_reader_giveaway":null,"finances":true,"setup_required":false,"force_ssl":true}';
        $signature = new Signature(compact('header', 'data'));

        $this->assertTrue($signature->validHmac('5ef7dd3db605eea3bc04950ec74d68b6'));
    }

    /** @test */
    function it_does_not_allow_empty_header()
    {
        $header = null;
        $data = null;
        $signature = new Signature(compact('header', 'data'));

        $this->assertFalse($signature->validHmac('5ef7dd3db605eea3bc04950ec74d68b6'));
    }
}