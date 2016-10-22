<?php 

namespace App\Http\Repositories;

use App\Http\Repositories\RetailerInterface;

use App\Retailer;
use App\Location;
use App\Brand;
use App\Merchant;
use App\User;


use DB;


class RetailerRepository implements RetailerInterface {


  public function proxy($domain, $param, $value) {

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
    ->where('domain', $domain)
    ->get();

    $collection = collect($data);
    $result = $collection->where($param, $value);
    $result->all();

    return $result;
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
