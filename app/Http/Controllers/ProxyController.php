<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

use App\Http\Repositories\RetailerInterface;

use App\Retailer;
use App\Location;

use GeoIP;
use View;
use DB;

class ProxyController extends Controller
{

private $retailer;
private $shop;

public function __construct(RetailerInterface $retailer) {
  $this->retailer = $retailer;
  $this->domain   = Input::get('shop');
}

/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/

public function index()
{

  $geo = $this->retailer->geoip('HTTP_X_FORWARDED_FOR');
  $exists = $this->retailer->exists('country_slug', str_slug($geo['country']));
  $stores = $this->retailer->retailers($this->domain);

  $retailer = $this->retailer->matrix([(float) $geo['lat'], (float) $geo['lon']], $stores);
  $countries = $this->retailer->countries($this->domain);

  $collection = collect($retailer);
  $retailers = $collection->sortBy('distance');
  $retailers->values()->all();

  $domain = $this->domain;

  if ($exists) {
    $iso = collect($retailers)->pluck(['country_code'])->first();
    $nation = collect($retailers)->where('country', $geo['country'])->pluck(['country'])->first();
  } else {
    $iso = $geo['isoCode'];
    $nation = "Select Country";
  }

  return response()->view('proxy.show', compact(
    'iso',
    'nation',
    'domain',
    'exists',
    'geo',
    'stores',
    'retailers',
    'countries'))
  ->header('Content-Type', env('PROXY_HEADER'));
}

/**
* Retailers By Country
*
* @return \Illuminate\Http\Response
*/

public function country(Request $request, $city)
{
  $country = Input::get('country');
  // GeoIP via proxy forward
  //
  $geo = $this->retailer->geoip('HTTP_X_FORWARDED_FOR');

  // Get Retailers WHERE "Country" is equal to the "Request"
  //
  $collection = collect($this->retailer->retailers($this->domain));
  $retailers  = $collection->where('country_slug', $country);
  $matrix = $this->retailer->matrix([(float) $geo['lat'], (float) $geo['lon']], $retailers);


  $sorted = collect($matrix);
  $retailers = $sorted->sortBy('distance');
  $retailers->values()->all();

  // Compact Variables
  //
  $countries  =  $this->retailer->countries($this->domain);
  $iso  = $retailers->pluck(['country_code'])->first();
  $exists     =  $country;

  // Return Response
  //
  return response()->view('proxy.index', compact(
    'geo',
    'iso',
    'retailers',
    'exists',
    'country',
    'countries',
    'cities'))
  ->header('Content-Type', env('PROXY_HEADER'));
}


public function origin(Request $request, $lat, $lng) {
  // Get Retailers WHERE "Country" is equal to the "Request"
  //
  $collection = collect($this->retailer->retailers($this->domain));
  $matrix = $this->retailer->matrix([(float) $lat, (float) $lng], $collection);
  //$distances = array();
  return $matrix;
  // Compact Variables
  //
  $countries  =  $this->retailer->countries($this->domain);
  $iso  = $retailers->pluck(['country_code'])->first();
  //$exists     =  $country;

  // Return Response
  //
  return response()->view('proxy.index', compact(
    'geo',
    'iso',
    'retailers',
    'exists',
    'country',
    'countries',
    'cities'))
  ->header('Content-Type', env('PROXY_HEADER'));
}
/**
* Retailers By City
*
* @return \Illuminate\Http\Response
*/

public function city(Request $request, $country, $city)
{
  /**
  * GeoIP via proxy forward
  */
  $geo = $this->retailer->geoip('HTTP_X_FORWARDED_FOR');

  /**
  * Compact
  */
  $countries  =  $this->retailer->countries($this->domain);
  $exists     =  $country;

  /**
  * Get Retailers as "Collection"
  */
  $collection = collect($this->retailer->retailers($this->domain));

  /**
  * Get Retailers where Country equals that of visitor
  */
  $retailers  = $collection->where('city_slug', $city);
  $retailers->all();


  /**
  * Get Cities relevant to that Country
  */
  $iso  = $retailers->pluck(['city'])->first();


  /**
  * Get Cities relevant to that Country
  */
  $cities  = $collection->unique('country');
  $cities->values()->all();

  /**
  * Return Response
  */
  return response()->view('proxy.index', compact(
    'geo',
    'iso',
    'retailers',
    'exists',
    'country',
    'countries',
    'cities'))
  ->header('Content-Type', env('PROXY_HEADER'));
}

/**
* Retailers By State
*
* @return \Illuminate\Http\Response
*/


public function search(Request $request)
{
  $shop      =  Input::get('shop');
  $retailers =  $this->retailer->find('domain',$shop);

  return json_decode($retailers);
}

/**
* Display the specified Retailer.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/

public function retailer(Request $request, $country, $city, $slug)
{
$shop      =  Input::get('shop');
$retailer =  $this->retailer->first('slug', $slug);


return response()
->view('proxy.retailer', compact('retailer'))
->header('Content-Type', env('PROXY_HEADER'));
}

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $slug)
  {
    $country = $slug;
    $retailers =  $this->retailer->find('slug', $slug);

    return response()->view('proxy.show', compact('retailers','country'))
    ->header('Content-Type', env('PROXY_HEADER'));
  }


  public function getCity($city)
  {

    $region = $city;

    $navigation = Location::orderBy('country', 'asc')
    ->groupBy('country')
    ->get();

    $listings = Location::where('city', $city)
    ->join('retailers', function($joinLocations)
    {
      $joinLocations->on('retailers.id', '=', 'locations.retailer_id');
    })
    ->groupBy('retailers.name')
    ->get();

    return response()
    ->view('proxy.country', compact(
      'listings',
      'navigation',
      'region'))
    ->header('Content-Type', env('PROXY_HEADER'));
  }

  public function getCountry($country)
  {
    $region = $country;

    $navigation = Location::orderBy('country', 'asc')
    ->groupBy('country')
    ->get();


    $listings = Location::where('country', $country)
    ->join('retailers', function($joinLocations)
    {
      $joinLocations->on('retailers.id', '=', 'locations.retailer_id');
    })
    ->groupBy('retailers.name')
    ->get();

    //return $listings;

    return response()
    ->view('proxy.country', compact(
      'region',
      'listings',
      'navigation'))
    ->header('Content-Type', env('PROXY_HEADER'));

  }




  public function getCountryJson($country)
  {

    $data = DB::table('locations')
    ->select('city')
    ->orderBy('country', 'asc')
    ->Where('country', 'LIKE', "%$country%")
    ->get();

    return Response::json($data);
  }



/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
 //
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
}


/**
* Show the seller for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{

}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{

}
}
