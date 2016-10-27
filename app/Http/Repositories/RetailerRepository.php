<?php

namespace App\Http\Repositories;

use App\Http\Repositories\RetailerInterface;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Collection;

use App\Retailer;
use App\Location;
use App\Brand;
use App\Merchant;
use App\User;

use GeoIP;
use DB;


class RetailerRepository implements RetailerInterface {


  /**
  * GeoIP
  *
  * Get Visitors Geographical Location
  *
  */
  public function geoip($header) {

    $forwarded  =  Request::server($header);
    $addresses  =  explode(',',$forwarded);
    $ip_address =  collect($addresses)->first();
    $locate     =  GeoIP::getLocation($ip_address);

    return $locate;
  }


  /**
  * Exists
  *
  * Check if Retailers "Exist" in Stores Database
  *
  */
  public function exists($resource, $query) {

    $data = DB::table('users')
    ->join('brands',      'users.id',     '=', 'brands.user_id')
    ->join('merchants',   'brands.id',    '=', 'merchants.brand_id')
    ->join('retailers',   'brands.id',    '=', 'retailers.brand_id')
    ->join('locations',   'retailers.id', '=', 'locations.retailer_id')
    ->select(
      'users.domain',
      'retailers.*',
      'locations.*')
    ->where($resource, $query)
    ->exists();

    return $data;
  }


  /**
  * Countries
  *
  * Get Retailer Countries of Specific Shopify Store
  *
  */
  public function countries($domain) {

    $data = DB::table('users')
    ->join('brands',      'users.id',     '=', 'brands.user_id')
    ->join('retailers',   'brands.id',    '=', 'retailers.brand_id')
    ->join('locations',   'retailers.id', '=', 'locations.retailer_id')
    ->select('locations.*')
    ->where('domain', $domain)
    ->get();

    $collection = collect($data);
    $locate = $collection->unique('country_slug');
    $locate->values()->all();

    return $locate;
  }


  /**
  * Retailers
  *
  * Get Retailers of Specific Shopify Store
  *
  */
  public function retailers($domain) {

    $data = DB::table('users')
    ->join('brands',      'users.id',     '=', 'brands.user_id')
    ->join('merchants',   'brands.id',    '=', 'merchants.brand_id')
    ->join('retailers',   'brands.id',    '=', 'retailers.brand_id')
    ->join('locations',   'retailers.id', '=', 'locations.retailer_id')
    ->select('retailers.*', 'locations.*')
    ->where('domain', $domain)
    ->get();

    return $data;
  }


/**
* Distance
*
* Get Distance Matrix from Google Maps API
*
*/

static function distance(array $origin, array $destination, $unit = "metric")
{
  // dd($origin, $destination);
  $theta = $origin[1] - $destination[1];
  $dist = sin(deg2rad($origin[0])) * sin(deg2rad($destination[0])) + cos(deg2rad($origin[0])) * cos(deg2rad($destination[0])) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtolower($unit);

  if ($unit == "metric") {
    return $miles * 1.609344;
  } elseif ($unit == "imperial") {
    return $miles;
  } else {
    throw new \ArgumentError("Unknown unit system given $unit");
  }
}

  public function matrix($origin, $retailers) {
    return $retailers->map(function ($retailer) use ($origin) {
      $retailer = (array) $retailer;
      $retailer["distance"] = round(self::distance([(float) $retailer["latitude"], (float) $retailer["longitude"]], $origin), 1) . " km";
      return $retailer;
    });
  }

}
