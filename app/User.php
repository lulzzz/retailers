<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Authenticatable
{
    use AuthenticableTrait;
    use Notifiable;
    use \NickyWoolf\Carter\OwnsShopifyStore;


    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password',

        // Carter Additions
        'domain', 'shopify_id', 'access_token', 'charge_id', 'installed'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',

        // Carter Additions
        'access_token'
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
