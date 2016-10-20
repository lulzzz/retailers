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

  public function proxy($domain, $param, $value); 
  public function first($resource, $slug); 
  public function find($resource, $query);
  public function pages($domain, $param, $number); 



}