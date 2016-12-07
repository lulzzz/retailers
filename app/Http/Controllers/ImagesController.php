<?php

namespace App\Http\Controllers;

use App\Http\Repositories\RetailerInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Brand;
use App\Retailer;
use App\Location;

use View;
use Auth;
use Redirect;
use Image;
//use Request;


class ImagesController extends Controller
{

  private $retailer;

  public function __construct(RetailerInterface $retailer) {
    $this->retailer = $retailer;
  }


  public function upload(Request $request, $id)
  {
    $logo = Input::file('logo');
    $storefront = Input::file('storefront');


    if ($logo) {

      $lg = $this->retailer->image('logo', $id, $logo, '.png', 600);
      $md = $this->retailer->image('logo', $id, $logo, '.png', 300);
      $sm = $this->retailer->image('logo', $id, $logo, '.png', 150);

      $retailers = Retailer::find($id);
      $retailers->logo_lg = Storage::url($lg);
      $retailers->logo_md = Storage::url($md);
      $retailers->logo_sm = Storage::url($sm);
      $retailers->update();

    } else if ($storefront) {

      $lg = $this->retailer->image('storefront', $id, $storefront, '.jpg', 1024);
      $md = $this->retailer->image('storefront', $id, $storefront, '.jpg', 768);
      $sm = $this->retailer->image('storefront', $id, $storefront, '.jpg', 480);

      $retailers = Location::find($id);
      $retailers->storefront_lg = Storage::url($lg);
      $retailers->storefront_md = Storage::url($md);
      $retailers->storefront_sm = Storage::url($sm);
      $retailers->update();

    }
    return response()->json();
  }



  public function delete($type, $id)
  {


    if ($type == 'logo') {
      // Find Logo
      $image = Retailer::find($id);

      // Delete
      Storage::deleteDirectory($id);

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
      Storage::deleteDirectory($id);

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
