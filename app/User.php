<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use \NickyWoolf\Carter\OwnsShopifyStore;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable {

 use Authenticatable, Notifiable, OwnsShopifyStore;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email',

    // Carter Additions
    'domain', 'shopify_id', 'access_token', 'charge_id', 'installed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token'

    // Carter Additions
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
