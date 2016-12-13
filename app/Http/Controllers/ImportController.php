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
      //return $export;

      return View::make('app.retailers.csv_import.index', compact('keys'));

   }



   public function retailers(Request $request) {
      // Get uploaded CSV file
      $file = Input::file('csv_file');
      $data = $this->retailer->processCsv($file);


      foreach ($data as $value) {
         // Try to find an existing Retailer
         //$retailer = Retailer::where("name", $value["name"])->get();

         // If the Retailer is not found
            // Insert a new Retailer and bind it
            $retailer = Retailer::insert(array(
               'user_id' => Auth::user()->id,
               'name' => $value['name'],
               'description' => $value['description'],
               //'phone' => $value['phone'],
               'email' => $value['email'],
               'website' => $value['website'],
               'instagram' => $value['instagram'],
               //'facebook' => $value['facebook'],
               'twitter' => $value['twitter'],
               'featured' => $value['featured'],
               'visibility' => $value['visibility'],
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
            ));
         

          $n = Retailer::where("name", $value["name"])->first();
          $n->id;

         // Here we either have an existing Retailer or the one we just created
         Location::insert(array(
            'retailer_id' =>  $n->id, //HERE IS THE ERROR
            'street_number' => $value['street_number'],
            'street_address' => $value['street_address'],
            'city' => $value['city'],
            'state' => $value['state'],
            'country' => $value['country'],
            'country_code' => $value['country_code'],
            'postcode' => $value['postcode'],
            'latitude' => $value['latitude'],
            'longitude' => $value['longitude'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ));
      }
      //return dd($data);


      return View::make('app.retailers.csv_import.success');
      //Location::insert($locations);
   }

   public function readme(Request $request)
   {
      return View::make('app.retailers.csv_import.readme');
   }


   public function transit(Request $request)
   {
      $this->retailer->retailers(Auth::user()->domain);
   }


   public function locations(Request $request)
   {
      // Get uploaded CSV file
      $file = Input::file('csv_file');
      $data = $this->retailer->processCsv($file);

      $locations = [];

      Location::insert($data);

      $date = new Carbon;
      $date->modify('-30 seconds');
      $formatted_date = $date->format('Y-m-d H:i:s');

      $retailer = Retailer::select('id','name')->where('user_id', Auth::user()->id)
      ->where('updated_at','>=',$formatted_date)->get();

      Location::insert($data);

      return 'done';
   }

}
