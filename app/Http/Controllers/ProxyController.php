<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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

    /**
    * GeoIP via proxy forward
    */
    $geo = $this->retailer->geoip('HTTP_X_FORWARDED_FOR');

    /**
    * Redirect if Retailer in user Country
    */
    $exists = $this->retailer->exists('country_slug', str_slug($geo['country']));

    if ($exists) {
      return Redirect::route('proxy_country', str_slug($geo['country']))->header('Content-Type', env('PROXY_HEADER'));
    }

    /**
    * Working Data
    */ 
    $countries  =  $this->retailer->countries($this->domain);
    $retailers  =  $this->retailer->retailers($this->domain);

    /**
    * Return Response
    */ 
    return response()->view('proxy.index', compact(
      'geo',
      'exists',
      'countries',
      'retailers'))
    ->header('Content-Type', env('PROXY_HEADER'));
  }

  /**
  * Retailers By Country
  *
  * @return \Illuminate\Http\Response
  */

  public function country(Request $request, $country)
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
    $retailers  = $collection->where('country_slug', $country);
    $retailers->all();

    /**
    * Get Cities relevant to that Country
    */
    $iso  = $retailers->pluck(['country_code'])->first();


    /**
    * Get Cities relevant to that Country
    */
    $cities  = $collection->unique('city');
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
