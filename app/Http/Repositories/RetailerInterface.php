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
  public function matrix($origin, $destinations, $retailers);
  public function retailers($domain); 
  public function exists($resource, $query); 




}