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
      return View::make('retailers.csv_import.export');

   }

   public function retailers(Request $request) {

      $retailer = Retailer::where('user_id', Auth::user()->id)->get();
      $csv = Writer::createFromFileObject(new \SplTempFileObject());
      $csv->insertOne([
         'user_id',
         'brand_id',
         'name',
         'type',
         'description',
         'phone',
         'website',
         'email',
         'instagram',
         'facebook',
         'created_at',
         'updated_at'
      ]);

      foreach ($retailer as $key => $value) {
         $csv->insertOne([
            'user_id' => Auth::user()->id,
            'brand_id' => Auth::user()->id,
            'name' => $value->name,
            'type' => $value->type,
            'description' => $value->description,
            'phone' => $value->phone,
            'email' => $value->email,
            'website' => $value->website,
            'instagram' => $value->instagram,
            'facebook' => $value->facebook,
            'created_at' => $value->created_at,
            'updated_at' => $value->updated_at
         ]);
      }

      $csv->output('retailers_'.str_slug(Carbon::now()).'.csv');
   }

   public function locations(Request $request) {

      $locations = $this->retailer->retailers(Auth::user()->domain);
      $csv = Writer::createFromFileObject(new \SplTempFileObject());
      $csv->insertOne([
         'retailer_id',
         'street_number',
         'street_address',
         'city',
         'state',
         'country',
         'country_code',
         'postcode',
         'latitude',
         'longitude',
         'created_at',
         'updated_at']);

         foreach ($locations as $key => $value) {
            $csv->insertOne([
               'retailer_id' => $value->retailer_id,
               'street_number' => $value->street_number,
               'street_address' => $value->street_address,
               'city' => $value->city,
               'state' => $value->state,
               'country' => $value->country,
               'country_code' => $value->country,
               'postcode' => $value->postcode,
               'latitude' => $value->latitude,
               'longitude' => $value->longitude,
               'created_at' => $value->created_at,
               'updated_at' => $value->updated_at
            ]);
         }

         $csv->output('locations_'.str_slug(Carbon::now()).'.csv');
      }
   }
