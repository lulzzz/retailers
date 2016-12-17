<?php

namespace App;

use Illuminate\Notifications\Notifiable;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use \NickyWoolf\Carter\OwnsShopifyStore;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

 use Notifiable, OwnsShopifyStore;

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
