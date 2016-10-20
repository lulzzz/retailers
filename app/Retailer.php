<?php

namespace App;

//use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Retailer extends Model
{

  use Sluggable;

  //use Searchable;

  protected $guarded = [];


  public static $rules = array(
    'name' => 'required',
    'type' => 'required',
    'visibility' => 'required'
    );

    /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
    public function sluggable()
    {
      return [
      'slug' => [
      'source' => 'name'
      ]
      ];
    }

  /**
  * A Retailer has many stores.
  *
  * @return array
  */
  public function locations()
  {
    return $this->hasMany('App\Location');
  }

}
