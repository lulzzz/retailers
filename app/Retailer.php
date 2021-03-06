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

  public function delete()
    {
        // delete all related photos
        $this->locations()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }
}
