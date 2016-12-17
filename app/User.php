<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use \NickyWoolf\Carter\OwnsShopifyStore;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
* The attributes that are mass assignable.
*
* @var array
*/

class User extends Authenticatable
{
    use Notifiable, OwnsShopifyStore;

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
