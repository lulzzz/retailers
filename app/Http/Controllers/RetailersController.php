<?php

namespace App\Http\Controllers;

// Illuminates
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use League\Csv\Writer;

// Modals
use App\Location;
use App\Retailer;
use App\Brand;

// Laravel
use View;
use DB;
use Auth;

class RetailersController extends Controller
{


  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

    $retailer = Retailer::where('user_id', Auth::user()->id)
    ->with('locations')
    ->get();

    return View::make('app.retailers.index', compact('retailer'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($type)
  {


    $retailer = Retailer::where('user_id', Auth::user()->id)->get();

    $title = $type;

    if (is_null($retailer))
    {
      return 'No Stores found! Start by adding some!';
    }
    return View::make('app.retailers.show', compact('retailer','title'));
  }


  /**
  * Create New Retailer
  *
  * @return Redirect to appropriate merchant edit.
  */
  public function create(Request $request)
  {

    $brand = Brand::where('user_id', Auth::user()->id)->first();

    $create = new Retailer;
    $create->user_id  = Auth::user()->id;
    $create->featured = 'no';
    $create->save();

    $id = Retailer::orderBy('created_at', 'desc')->first();

    return Redirect::route('retailers.edit', compact('id'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $retailer_input = $request->except([
      'brand_name',
      'user_id',
      'city',
      'state',
      'postcode',
      'country',
      'country_code',
      'longitude',
      'latitude',
      'storefront',
      'logo',
      'instore']);


      $validation = Validator::make($retailer_input, Retailer::$rules);

      if ($validation->passes())
      {
        Retailer::create($retailer_input);
        return Redirect::route('retailers.index')
        ->with('message', 'Retailer Added!');
      }

      return Redirect::route('retailers.create')
      ->withInput()
      ->withErrors($validation)
      ->with('message', 'There were validation errors.');
    }


    /**
    * Show the seller for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {

      $brand = Brand::where('user_id', Auth::user()->id)
      ->first();

      // Get Retailer Information
      $retailer = Retailer::where('id', $id)->first();

      // Paginate
      $prev = Retailer::where('id', '<', $retailer->id)->max('id');
      $next = Retailer::where('id', '>', $retailer->id)->min('id');

      // Locatios
      $location = Location::where('retailer_id', $retailer->id)
      ->orderBy('created_at', 'desc')
      ->get();

      // Redirect if no Seller found.
      if (is_null($retailer))
      {
        return Redirect::route('retailers.index');

      } else {

        return View::make('app.retailers.edit', compact(
          'retailer',
          'location',
          'storefront',
          'id',
          'prev',
          'next'));
        }
      }


      /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function update(Request $request, $id)
      {
        // Get Retailers Table Input
        $retailers_input = $request->only([
          'name',
          'description',
          'featured',
          'visibility',
          'email',
          'website',
          'instagram']);

          // Get Retailers Table Input
          $retailers = Retailer::find($id);
          $retailers->update($retailers_input);

          return Redirect::route('retailers.edit', $id)
          ->withInput()
          ->with('message', 'There were validation errors.');
        }

        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function destroy($id)
        {

          Retailer::destroy($id);


          // redirect
          return'removed';
        }



      }
