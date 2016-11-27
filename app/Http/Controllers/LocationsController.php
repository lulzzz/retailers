<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Location;
use App\Retailer;
use App\Merchant;
use App\Brand;

use View;
use DB;
use Auth;


class LocationsController extends Controller
{

  //private $name;

  public function __construct()
  {
    $this->middleware('auth');
    //$this->name = $name;

  }

  public function index()
  {

    $navigation = Merchant::select('merchants')
    ->where('user_id', Auth::user()->id)
    ->get();

    $id = Retailer::where('user_id', Auth::user()->id)->first();
    $location = Location::where('retailer_id', $id->id)->get();

    return View::make('app.retailers.locations', compact('location', 'navigation','id'));
  }

  public function show($id)
  {
    $brand = Brand::select('brand_name')
    ->where('user_id', Auth::user()->id)
    ->first();

    $navigation = Merchant::select('merchants')
    ->where('brand_id', $brand->id)
    ->get();

    $id = Retailer::where('user_id', Auth::user()->id)->first();

    $location = Location::where('retailer_id', $id->id)->get();
    return View::make('app.retailers.locations', compact('location', 'navigation', 'id'));
  }

  public function addressView(Request $request, $id)
  {
    $location = Location::where('id', $id)->first();
    return View::make('app.locations.address', compact('location'));
  }


  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function addressSave(Request $request, $id)
  {

    // Get Locations Table Input
    $input = $request->only([
      'street_number',
      'street_address',
      'city',
      'state',
      'postcode',
      'country',
      'country_code',
      'longitude',
      'latitude']
    );

    $post = Location::find($id);
    $post->save($input);

    return Redirect::back();
  }

  public function update(Request $request, $id)
  {

    // Get Locations Table Input
    $input = $request->only([
      'street_number',
      'street_address',
      'city',
      'state',
      'postcode',
      'country',
      'country_code',
      'longitude',
      'latitude']
    );

    $validation = Validator::make($input, Location::$rules);

    if ($validation->passes())
    {

      $post = Retailer::find($id);
      $data = new Location($input);
      $data = $post->locations()->save($data);

      return 'success';
    }

    return response()->json([
      'success' => 'success message',
    ])
    ->withInput()
    ->withErrors($validation)
    ->with('message', 'There were validation errors.');
  }


  public function edit(Request $request, $id)
  {

    $brand = Brand::select('brand_name')
    ->where('user_id', Auth::user()->id)
    ->first();

    $navigation = Merchant::select('merchants')
    ->where('brand_id', $brand->id)
    ->get();

    $retailer = Retailer::where('user_id', Auth::user()->id)->first();
    $location = Location::where('id', $id)->first();

    return View::make('app.locations.edit', compact('location', 'navigation', 'retailer', 'id'));
  }


  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {

    $locations = Location::find($id);
    if ($locations) {
      $locations->delete();
    }
    $retailer = Retailer::where('user_id', Auth::user()->id)->first();

    return response()->json();

  }

}
