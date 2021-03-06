<?php

namespace NickyWoolf\Carter;

class ShopifySignatureHttp extends ShopifySignature
{
    public function validHmac($secret)
    {
        return $this->request('hmac') === $this->hash($this->message(), $secret, false);
    }
}