<?php

namespace App;

//use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Location extends Model
{
    //use Searchable;
  use Sluggable;


  protected $guarded = [];

  public static $rules = array(
    'country' => 'required',
    'city' => 'required'
    );

  /**
   * stores belong to retailer/s.
   *
   * @return array
   */
  public function retailer()
  {
    return $this->belongsTo('App\Retailer');
  }

  public function sluggable()
  {
    return [
    'country_slug' => [
    'source' => 'country'
    ],
    'city_slug' => [
    'source' => 'city'
    ],
    'state_slug' => [
    'source' => 'state'
    ],
    'street_address_slug' => [
    'source' => 'state'
    ],
    'postcode_slug' => [
    'source' => 'state'
    ]
    ];
  }
}
