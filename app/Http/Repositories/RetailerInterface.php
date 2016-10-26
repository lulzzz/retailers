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
  * Shopify Api Connection
  *
  * @return connection
  */

  public function geoip($header);
  public function countries($domain);
  public function matrix($domain, $country);
  public function combine($collections);
  public function retailers($domain); 
  public function first($resource, $slug); 
  public function find($resource, $query);
  public function pages($domain, $param, $number); 
  public function exists($resource, $query); 




}