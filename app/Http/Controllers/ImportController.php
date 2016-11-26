<?php

namespace App\Http\Controllers;

// Illuminates
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

// Repositories
use App\Http\Repositories\RetailerInterface;

// Modals
use App\Location;
use App\Retailer;
use App\Merchant;
use App\Brand;
use App\Export;

// Laravel
use View;
use DB;
use Auth;
use Excel;
use Storage;

// Packages
use Carbon\Carbon;
use League\Csv\Writer;
use League\Csv\Reader;


class ImportController extends Controller
{

   private $retailer;

   public function __construct(RetailerInterface $retailer) {
      $this->middleware('auth');
      $this->retailer = $retailer;
   }

   /**
   * Export Retailers of current user to CSV file.
   *
   * @return \League\Csv\Writer
   */

   public function index() {

      $brand = Brand::where('user_id', Auth::user()->id)->first();
      $values = Export::where('brand_id', $brand->id)->get();

      //return $export;

      return View::make('retailers.csv_import.index', compact('keys', 'values'));

   }



   public function retailers(Request $request) {
      // Get uploaded CSV file
      $file = Input::file('csv_file');
      $data = $this->retailer->processCsv($file);

      $retailers = [];

      foreach ($data as $value) {
         $retailers[] = array(
            'user_id' => Auth::user()->id,
            'brand_id' => Auth::user()->id,
            'name' => $value['name'],
            'description' => $value['description'],
            'email' => $value['email'],
            'phone' => $value['phone']
         );
      }

      Retailer::insert($retailers);

      return Redirect::route('import_locations');
      //Location::insert($locations);
   }


   public function locations(Request $request)
   {
      // Get uploaded CSV file
      $file = Input::file('csv_file');
      $data = $this->retailer->processCsv($file);

      $locations = [];

      foreach ($data as $key => $value) {
         $locations[] = array(
            'retailer_id' =>  $value['retailer_id'],
            'street_number' => $value['street_number'],
            'street_address' => $value['street_address'],
            'city' => $value['city'],
            'state' => $value['state'],
            'country' => $value['country'],
            'country_code' => $value['country'],
            'postcode' => $value['postcode'],
            'latitude' => $value['latitude'],
            'longitude' => $value['longitude']
         );
      }

      Location::insert($locations);
      //Location::insert($locations);
      return $locations;
   }

}
