<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{

  protected $guarded = [
  //
  ];

  protected $casts = [
    'csv_import' => 'json'
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
