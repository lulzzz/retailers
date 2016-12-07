<?php

namespace App\Http\Repositories;


/**
* API Connections
*
* Calls API connections for SILK and
* Shopify in Controllers.
*
*/

interface RetailerInterface {

  /**
  * Retailer Proxy Storefront Logics
  *
  * @return connection
  */

  public function geoip($header);
  public function countries($domain);
  public function matrix($origin, $retailers);
  public function retailers($domain);
  public function exists($resource, $query);
  public function image($type, $id, $input, $file, $width);
  public function processCsv($file);
  public function recentImports($time);

  public function getGroupedArray($array, $keyFieldsToGroup);
}
