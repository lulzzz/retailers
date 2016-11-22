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

// Laravel
use View;
use DB;
use Auth;

// Packages
use Carbon\Carbon;
use League\Csv\Writer;


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

   public function export() {

      $brand = Brand::where('user_id', Auth::user()->id)
      ->first();

      $navigation = Merchant::select('merchants')
      ->where('brand_id', $brand->id)
      ->get();

      $retailer = $this->retailer->retailers(Auth::user()->domain);
      $retailers = array('retailers' => $retailer);

      $csv = Writer::createFromFileObject(new \SplTempFileObject());
      $csv->insertOne([
         'name',
         'type',
         'description',
         'street_number',
         'street_address',
         'city',
         'state',
         'country',
         'country_code',
         'postcode',
         'latitude',
         'longitude',
         'email',
         'phone',
         'website',
         'instagram',
         'facebook',
         'created_at',
         'updated_at',
         'exported_at'
      ]);

      foreach ($retailer as $key => $value) {
         $csv->insertOne([
            'name' => $value->name,
            'type' => $value->type,
            'description' => $value->description,
            'street_number' => $value->street_number,
            'street_address' => $value->street_address,
            'city' => $value->city,
            'state' => $value->state,
            'country' => $value->country,
            'country_code' => $value->country,
            'postcode' => $value->postcode,
            'latitude' => $value->latitude,
            'longitude' => $value->longitude,
            'email' => $value->email,
            'phone' => $value->phone,
            'website' => $value->website,
            'instagram' => $value->instagram,
            'facebook' => $value->facebook,
            'created_at' => $value->created_at,
            'updated_at' => $value->updated_at,
            'exported_at' => Carbon::now()
         ]);
      }

      $csv->output('retailers_'.str_slug(Carbon::now()).'.csv');
   }
}
