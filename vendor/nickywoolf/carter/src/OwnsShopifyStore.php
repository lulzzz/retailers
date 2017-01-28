<?php

namespace NickyWoolf\Carter;

trait OwnsShopifyStore
{
    public function forShop($shop)
    {
        return static::whereDomain($shop)->first();
    }

    public function isActive()
    {
        return (bool) $this->installed;
    }

    public function install()
    {
        return $this->update(['installed' => true]);
    }

    public function uninstall()
    {
        return $this->update([
            'name' => null,
            'email' => null,
            'password' => null,
            'shopify_id' => null,
            'access_token' => null,
            'installed' => false
        ]);
    }

    public function setAccessTokenAttribute($value)
    {
        $this->attributes['access_token'] = encrypt($value);
    }

    public function getAccessTokenAttribute()
    {
        return decrypt($this->attributes['access_token']);
    }
}
