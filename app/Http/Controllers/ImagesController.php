<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Brand;
use App\Retailer;
use App\Location;

use View;
use Auth;
use Redirect;


class ImagesController extends Controller
{

  public function index($id)
  { 

    $brand = Brand::where('user_id', Auth::user()->id)
    ->first();

    $logo = Retailer::where('brand_id', $brand->id)->first();

    return View::make('upload.logos', compact('logo', 'retailer', 'id'));
  }


  public function upload($id)
  {
    $logo = Input::file('logo');
    $storefront = Input::file('storefront');

    $brand = Brand::where('user_id', Auth::user()->id)
    ->first();

    $retailer = Retailer::where('brand_id', $brand->id)
    ->first();

    if ($logo) {

      $input = $logo->store('public/logos/'.$retailer->slug);

      // Get Retailers Table Input
      $retailers = Retailer::find($id);
      $retailers->logo_lg = $input;
      $retailers->update();

    } else if ($storefront) {

      $input = $storefront->store('public/storefronts/'.$retailer->slug);

     // Get Retailers Table Input
      $retailers = Location::find($id);
      $retailers->storefront_lg = $input;
      $retailers->update();

    }
    return response()->json();
  }



  public function deleteLogo($type, $id)
  {


    if ($type == 'logo') {
      // Find Logo
      $image = Retailer::find($id);

        // Images path to delete from Storage
      $logos = array(
        'logo_sm' => $image->logo_sm,
        'logo_md' => $image->logo_md,
        'logo_lg' => $image->logo_lg
        );

       // Delete
      Storage::delete($logos);

     // Make record in database NULL
      $nullable = array(
        'logo_sm' => null,
        'logo_md' => null,
        'logo_lg' => null
        );

    // Perform action!
      $image->update($nullable);

    } else if ($type == 'storefront') {
     // Find Logo
      $image = Location::find($id);

        // Images path to delete from Storage
      $storefronts = array(
        'storefront_sm' => $image->storefront_sm,
        'storefront_md' => $image->storefront_md,
        'storefront_lg' => $image->storefront_lg
        );

       // Delete
      Storage::delete($storefronts);

     // Make record in database NULL
      $nullable = array(
        'storefront_sm' => null,
        'storefront_md' => null,
        'storefront_lg' => null
        );

    // Perform action!
      $image->update($nullable);
    }

    return response()->json();

  }
}