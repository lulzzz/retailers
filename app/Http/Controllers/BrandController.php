<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Queue\QueueableCollection;

//use App\Http\Repositories\AdminInterface;

use App\User;
use App\Brand;
//use App\Retailer;
//use App\Location;
//use App\Merchant;

use View;
use Auth;



class BrandController extends Controller
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
    return View::make('app.brand.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */


  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function show(Request $request, $id)
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
    $brand = $request->only(['brand_name']);

    $validation = Validator::make($brand, Brand::$rules);

    if ($validation->passes())
    {
      $id = Auth::user()->id;
      $create = User::find($id);
      $insert = new Brand($brand);
      $insert = $create->brand()->save($insert);

      return Redirect::route('retailers.index');
    }

    return Redirect::route('app.brand.index')
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
    $brand = Brand::find($id);
    return View::make('app.brand.edit', compact('brand'));
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
    // Get Locations Table Input
    $input = $request->only(['brand_name']);


    $post = Brand::find($id);
    $post->update($input);

    return Redirect::route('app.retailers.index');

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
