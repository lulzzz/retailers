<?php

namespace NickyWoolf\Carter;

class ShopifySignatureWebhook extends ShopifySignature
{
    public function validHmac($secret)
    {
        $header = $this->request('header');

        return $header === base64_encode($this->hash($this->request('data'), $secret, true));
    }
}