<?php

namespace App\Http\Repositories;

use App\Http\Repositories\RetailerInterface;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

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
      ->select('locations.country','locations.country_code','locations.country_slug')
      ->where('domain', $domain)
      ->get();

      $locate = collect($data)->unique('country_slug');

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
    static function distance(array $origin, array $destination, $unit = "metric") {
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
        $retailer["distance"] = round(self::distance([(float) $retailer["latitude"], (float) $retailer["longitude"]], $origin), 2);
        return $retailer;
      });
    }


    /**
    * Image Upload
    *
    * Upload responsive image files to AWS
    *
    */
    public function image($type, $id, $input, $file, $width) {

      $manager = new ImageManager();

      $filename = str_random() . $file;

      $image = $manager->make($input)->resize($width, null, function ($constraint) {
        $constraint->aspectRatio();
      })->stream();

      $path = $id.'/'.$type.'/'.$width.'--'.$filename;

      $s3 = Storage::disk('s3');
      $s3->put($path, (string)$image, 'public');

      return $path;
    }
  }
