<?php

namespace App\Http\Controllers;

// Illuminates
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use League\Csv\Writer;

use App\Http\Repositories\RetailerInterface;


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

  private $retailer;

  public function __construct(RetailerInterface $retailer) {
    $this->retailer = $retailer;
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

    foreach ($retailer as $key => $value) {

      $retailers[] = array(
        'id' => $value->id,
        'logo_sm' => $value->logo_sm,
        'name' => $value->name,
        'city' => $value->city,
        'visibility' => $value->visibility,
        'updated_at' => $value->updated_at
      );
    }


    $indentifiers = collect($retailer)->pluck('id');

    $ids = str_replace(array('[', ']'), '', htmlspecialchars(
      json_encode($indentifiers), ENT_NOQUOTES)
    );

    return View::make('app.retailers.index', compact('retailer','ids'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show()
  {

    $retailer = Retailer::where('user_id', Auth::user()->id)
    ->with('locations')
    ->get();

    $indentifiers = collect($retailer)->pluck('id');

    $ids = str_replace(array('[', ']'), '', htmlspecialchars(
      json_encode($indentifiers), ENT_NOQUOTES)
    );

    return View::make('app.retailers.index', compact('retailer','ids'));
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
          $retailer = Retailer::find($id);
          $retailer->delete();

          $location = location::where('retailer_id', $id)->get();
          $location->delete();
          // redirect
          return Redirect::route('retailers.index');
        }

        public function destroyAll()
        {
          DB::table('locations')->delete();
          DB::table('retailers')->delete();


          return Redirect::route('retailers.index')
          ->with('message', 'Retailer removed!');

        }



      }
