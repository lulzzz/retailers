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
use App\Image;


// Laravel
use View;
//use Image;
use DB;
use Auth;


class TemplatesController extends Controller
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

    $brand = Brand::where('user_id', Auth::user()->id)
    ->first();

    $navigation = Merchant::select('merchants')
    ->where('brand_id', $brand->id)
    ->get();

    return View::make('app.templates.index', compact('navigation'));
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

//
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

      //

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

  }

}
