<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{

  protected $guarded = [
  //
  ];

  public static $rules = array(
    'merchants' => 'unique:brand_id'
    );

  protected $casts = [
    'merchants' => 'json'
  ];
  /**
   * The "Merchants" belong to a "Brand".
   *
   * @return array
   */
  public function brand()
  {
    return $this->belongsTo('App\Brand');
  }
}
