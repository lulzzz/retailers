<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


use App\User;
use App\Brand;
use App\Merchant;
use App\Retailer;
use App\Location;

use View;
use Auth;
use Redirect;



class DashboardController extends Controller
{


   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $brand = Brand::where('user_id', Auth::user()->id)->exists();

      // Globals
      //
      if (!$brand) {
         return Redirect::route('brand.index');
      } else {
         return Redirect::route('retailers.index');
      }

   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {

      $navigation = Merchant::select('merchants')
      ->where('brand_id', $id)
      ->get();

      return View::make('dashboard', compact('navigation'));
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
   public function delete(Request $request)
   {
      $ids = $request->only('ids');

      Retailer::destroy($ids);
      return Redirect::back();
   }
}
