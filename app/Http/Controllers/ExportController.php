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


class ExportController extends Controller
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
      return View::make('app.retailers.csv_import.export');

   }

   public function retailers(Request $request) {

      $retailer = $this->retailer->retailers(Auth::user()->domain);
      $csv = Writer::createFromFileObject(new \SplTempFileObject());
      $csv->insertOne([
         'retailer_id',
         'name',
         'description',
         'phone',
         'website',
         'email',
         'instagram',
         'facebook',
         'twitter',
         'featured',
         'visibility',
         'street_number',
         'street_address',
         'city',
         'state',
         'country',
         'country_code',
         'postcode',
         'latitude',
         'longitude'
      ]);

      foreach ($retailer as $key => $value) {
         $csv->insertOne([
            'retailer_id' => $value->retailer_id,
            'name' => $value->name,
            'description' => $value->description,
            'phone' => $value->phone,
            'email' => $value->email,
            'website' => $value->website,
            'instagram' => $value->instagram,
            'facebook' => $value->facebook,
            'twitter' => $value->twitter,
            'featured' => $value->featured,
            'visibility' => $value->visibility,
            'street_number' => $value->street_number,
            'street_address' => $value->street_address,
            'city' => $value->city,
            'state' => $value->state,
            'country' => $value->country,
            'country_code' => $value->country_code,
            'postcode' => $value->postcode,
            'latitude' => $value->latitude,
            'longitude' => $value->longitude
         ]);
      }

      $csv->output('app.retailers_'.str_slug(Carbon::now()).'.csv');
   }

}
