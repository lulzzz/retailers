<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

  protected $guarded = [
    //
  ];

  // Form Input
  public static $rules = array(
    'brand_name' => 'required'
    );

  /**
  * A Retailer has many stores.
  *
  * @return array
  */
  public function user()
  {
    return $this->belongsTo('App\User');
  }

}
