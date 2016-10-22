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

  public function __construct(RetailerInterface $retailer) {
    $this->retailer = $retailer;
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
    $forwarded  =  Request::server('HTTP_X_FORWARDED_FOR');
    $addresses  =  explode(',',$forwarded);
    $ip_address =  collect($addresses)->first();
    $locate     =  GeoIP::getLocation($ip_address);

    $country    =  str_slug($locate['country']);
    $iso        =  strtolower($locate['isoCode']);
    $exists     =  $this->retailer->exists('country_slug', $country);

    if ($exists) {
     return Redirect::route('proxy_country', $country);
   } 

    /**
    * Working Data
    */ 
    $shop       =  Input::get('shop');
    $locations  =  $this->retailer->find('domain',$shop);
    $retailers  =  $this->retailer->pages('domain', $shop, 100);

    /**
    * Collect Locations
    */
    $collection =  collect($locations);

    /**
    * Unqiue Country
    */
    $countries  =  $collection->unique('country_slug');
    $countries->values()->all();

    $lat = $locate['lat'];
    $lon = $locate['lon'];

    // Query User and Find Retailers
    // 

   // return $locate;


   // return $locations;
   // 
    //$country  = $this->retailer->proxy($shop, 'country', $locate['country']);

    //return $retailers;
    $retailers  = $this->retailer->pages('domain', $shop, 100);

    return response()
    ->view('proxy.index', compact('retailers','exists','country','countries','cities','shop','lat','lon','iso'))
    ->header('Content-Type', env('PROXY_HEADER'));
    
  }
    //return  Redirect::route('proxy-country', $data->country);
    //
  public function search(Request $request)
  {
    $shop      =  Input::get('shop');
    $retailers =  $this->retailer->find('domain',$shop);

    return json_decode($retailers);
  }


  /**
  * Retailers By Country
  *
  * @return \Illuminate\Http\Response
  */

  public function country(Request $request, $country)
  {

    /**
    * Working Data
    */ 
    $shop       =  Input::get('shop');
    $locations  =  $this->retailer->find('domain',$shop);
    $retailers  =  $this->retailer->proxy($shop, 'country_slug', $country);

    /**
    * Collect Locations
    */
    $collection =  collect($locations);

    /**
    * Unqiue Country
    */
    $countries  =  $collection->unique('country_slug');
    $countries->values()->all();


    /**
    * Get Cities
    */
    $collection =  collect($retailers);

    /**
    * Unqiue Country
    */
    $cities  =  $collection->unique('city');
    $cities->values()->all();

    $exists = $country;

    return response()
    ->view('proxy.show', compact('retailers', 'exists','country','countries','cities'))
    ->header('Content-Type', env('PROXY_HEADER'));
  }

  /**
  * Retailers By City
  *
  * @return \Illuminate\Http\Response
  */

  public function city(Request $request, $country, $city)
  {
    $shop      =  Input::get('shop');
    $retailers =  $this->retailer->proxy($shop, 'city_slug', $city);

    return response()
    ->view('proxy.show', compact('retailers'))
    ->header('Content-Type', env('PROXY_HEADER'));
  }

  /**
  * Retailers By State
  *
  * @return \Illuminate\Http\Response
  */


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
