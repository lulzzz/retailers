<?php

namespace App\Http\Controllers;

// Illuminates 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

// Interfaces \ Repositories
//use App\Http\Repositories\AdminInterface;

// Modals
use App\Location;
use App\Retailer;
use App\Merchant;
use App\Brand;


// Laravel
use View;
//use Image;
use DB;
use Auth;


class RetailersController extends Controller
{


  //private $name;

  public function __construct()
  {
    $this->middleware('auth');
        //$this->name = $name;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($type)
  {   
    //
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request, $type)
  {

    $brand = Brand::where('user_id', Auth::user()->id)
    ->first();

    $create = new Retailer;
    $create->user_id  = Auth::user()->id;
    $create->brand_id = $brand->id;
    $create->type = 'website';
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
    //
  }


  /**
   * Show the seller for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

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
      return View::make('retailers.edit', compact(
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
      'type',
      'description',
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
      //
    $retailer = Retailer::find($id);
    $retailer->delete();

      // redirect
    return Redirect::route('retailers.index');
  }

}
