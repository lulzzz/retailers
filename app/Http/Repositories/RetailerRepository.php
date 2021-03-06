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
      ->join('retailers',   'users.id',    '=', 'retailers.user_id')
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
         ->join('retailers',   'users.id',    '=', 'retailers.user_id')
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
         ->join('retailers',   'users.id',    '=', 'retailers.user_id')
         ->join('locations',   'retailers.id', '=', 'locations.retailer_id')
         ->select('retailers.*', 'locations.*')
         ->where('domain', $domain)
         ->get();

         return $data;
      }


      /**
      * Retailers
      *
      * Get Retailers of Specific Shopify Store
      *
      */
      public function recentImports($time) {

         $data = DB::table('users')
         ->join('brands',      'users.id',     '=', 'brands.user_id')
         ->join('retailers',   'users.id',    '=', 'retailers.user_id')
         ->join('locations',   'retailers.id', '=', 'locations.retailer_id')
         ->select('retailers.*', 'locations.*')
         ->where('updated_at', '>=', $time)
         ->get();

         return $data;
      }




      /**
      * Distance
      *
      * Get Distance Matrix from Google Maps API
      *
      */
      static function distance(array $origin, array $destination, $geo) {
         $theta = $origin[1] - $destination[1];
         $dist = sin(deg2rad($origin[0])) * sin(deg2rad($destination[0])) + cos(deg2rad($origin[0])) * cos(deg2rad($destination[0])) * cos(deg2rad($theta));
         $dist = acos($dist);
         $dist = rad2deg($dist);
         $miles = $dist * 60 * 1.1515;
         //$unit = strtolower($unit);

         if ($geo == "US") {
            return  $miles;
         } else {
            return  $miles * 1.609344;
         }
      }


      public function matrix($origin, $retailers, $geo) {

         return $retailers->map(function ($retailer) use ($origin, $geo) {
            $retailer = (array) $retailer;
            $retailer["distance"] = round(self::distance([(float) $retailer["latitude"], (float) $retailer["longitude"]], $origin, $geo), 2);
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


      public  function processCsv($file)
      {
         $csv = array_map('str_getcsv', file($file));
         $headers = $csv[0];
         unset($csv[0]);
         $rowsWithKeys = [];
         foreach ($csv as $row) {
            $newRow = [];
            foreach ($headers as $k => $key) {
               $newRow[$key] = $row[$k];
            }
            $rowsWithKeys[] = $newRow;
         }
         return $rowsWithKeys;
      }


      public function getGroupedArray($array, $keyFieldsToGroup) {
         $newArray = array();

         foreach ($array as $record)
         $newArray = getRecursiveArray($record, $keyFieldsToGroup, $newArray);
         return $newArray;
      }

      public function getRecursiveArray($itemArray, $keys, $newArray) {
         if (count($keys) > 1)
         $newArray[$itemArray[$keys[0]]] = getRecursiveArray($itemArray, array_splice($keys, 1), $newArray[$itemArray[$keys[0]]]);
         else
         $newArray[$itemArray[$keys[0]]][] = $itemArray;

         return $newArray;
      }
   }
