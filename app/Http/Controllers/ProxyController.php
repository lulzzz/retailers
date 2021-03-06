<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

use App\Http\Repositories\RetailerInterface;

use App\User;
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


  public function origin(Request $request, $lat, $lng) {

    $geo  = $this->retailer->geoip('HTTP_X_FORWARDED_FOR');

    if($this->domain == 'brixtol.myshopify.com') {
      $domain = 'brixtol-se.myshopify.com';
    } else {
      $domain = $this->domain;
    }

    $collection = collect($this->retailer->retailers($domain));
    $matrix = $this->retailer->matrix([(float) $lat, (float) $lng], $collection, $geo['isoCode']);

    return $matrix;
  }


  /**
  * Landing Page.
  *
  * Function accessed via /a/retailers from Shopify and is the
  * landing page for the storefront side of the app. Most the internal
  * logic is in the Retailers Repository.
  *
  * @return \Illuminate\Http\Response
  */

  public function index() {

    $geo        = $this->retailer->geoip('HTTP_X_FORWARDED_FOR');
    $exists     = $this->retailer->exists('country_slug', str_slug($geo['country']));

    if($this->domain == 'brixtol.myshopify.com') {
      $domain = 'brixtol-se.myshopify.com';
    } else {
      $domain = $this->domain;
    }


    $stores     = $this->retailer->retailers($domain);
    $countries  = $this->retailer->countries($domain);
    $listings   = $this->retailer->matrix([(float) $geo['lat'], (float) $geo['lon']], $stores, $geo);

    $collection = collect($listings);
    $retailers = $collection->where('visibility', 'public')->sortBy('distance');
    $retailers->values()->all();

    $brand  = collect($retailers)->pluck(['brand_name'])->first();

    if ($exists) {
      $error = false;
    } else {
      $error = true;
    }

    return response()->view('proxy.show', compact(
      'iso',
      'nation',
      'brand',
      'error',
      'domain',
      'exists',
      'geo',
      'stores',
      'retailers',
      'countries'))
      ->header('Content-Type', env('PROXY_HEADER')
    );
  }

  public function retailer(Request $request, $store) {

    $user = User::where('domain', $this->domain)->first();
    $retailer = Retailer::where('user_id', $user->id)->where('slug', $store)->first();
    $geo = Location::where('retailer_id', $retailer->id)->first();
    $locations = Location::where('retailer_id', $retailer->id)->get();
    $domain     = $this->domain;

    return response()->view('proxy.retailer', compact('retailer', 'locations','domain','geo'))
    ->header('Content-Type', env('PROXY_HEADER')
  );
}

}
