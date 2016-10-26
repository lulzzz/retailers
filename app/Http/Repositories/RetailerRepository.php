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
  * Locations
  *
  * Get Retailer Locations for Specific Shopify Store
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

  public function matrix($domain, $country) {

    $data = DB::table('users')
    ->join('brands',      'users.id',     '=', 'brands.user_id')
    ->join('retailers',   'brands.id',    '=', 'retailers.brand_id')
    ->join('locations',   'retailers.id', '=', 'locations.retailer_id')
    ->select('locations.*')
    ->where('domain', $domain)
    ->get();

    $collection = collect($data);
    $locate = $collection->unique('city');
    $locate->values()->toArray();


    $matrix = \GoogleMaps::load('distancematrix')
    ->setParam(['origins' => $city])      
    ->setParam(['destinations' => $locate])   
    ->get('rows.elements.distance');

    return $matrix;
  }


  public function combine($collections) {
    $merged = new Collection();
    $max = count($collections[key($collections)]);
    for($i = 0; $i < $max; $i++)
    {
      $item = new \stdClass();
      foreach($collections as $key => $collection) {
        $item->{$key} = $collection[$i];
      }
      $merged->add($item);
    }
    return $merged;
  }


  public function first($resource, $slug) {

    $data = DB::table('users')
    ->join('brands',      'users.id',     '=', 'brands.user_id')
    ->join('merchants',   'brands.id',    '=', 'merchants.brand_id')
    ->join('retailers',   'brands.id',    '=', 'retailers.brand_id')
    ->join('locations',   'retailers.id', '=', 'locations.retailer_id')
    ->select(
      'users.name',
      'users.domain',       
      'retailers.*', 
      'locations.*')
    ->where('slug', $slug)
    ->first();

    return $data;
  }

  public function find($resource, $query) {

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
    ->get();

    return $data;
  }


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

  public function pages($resource, $query, $number) {

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
    ->paginate($number);

    return $data;
  }

}
