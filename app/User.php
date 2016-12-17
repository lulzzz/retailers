<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, OwnsShopifyStore;

    protected $fillable = [
        'name', 'email', 'password',
        'shopify_id', 'domain', 'access_token', 'charge_id', 'installed',
    ];

    protected $hidden = [
        'password', 'remember_token', 'access_token'
    ];

    /**
    * Every "User" has 1 Brand.
    *
    * @var array
    */
    public function brand()
    {
        return $this->hasOne('App\Brand');
    }
}
