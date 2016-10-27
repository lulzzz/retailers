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
  public function matrix($origin, $destinations, $retailers) {

    $matrix = \GoogleMaps::load('distancematrix')
    ->setParam(['origins' => $origin])      
    ->setParam(['destinations' => $destinations])
    ->get('rows.elements.distance.text');

    $collection = collect($matrix);
    $distances = $collection->flatten();
    $distances->toArray();

    $distance = [];

    foreach ($distances as $key => $value) {
      $distance[] = '{"distance" : "'+$value+'"}';
    }

    $combination = array_combine($distances->toArray(), $retailers->toArray());

    return $combination;
  }

}
