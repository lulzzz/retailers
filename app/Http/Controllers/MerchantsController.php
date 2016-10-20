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
use App\Merchant;

//use App\Retailer;
//use App\Location;

use View;
use Auth;



class MerchantsController extends Controller
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
        // If Exists
        $brand = Brand::where('user_id', Auth::user()->id)->first();
        $merchant = Merchant::where('brand_id', $brand->id)->exists();

        if ($merchant) {
            return Redirect::route('retailers.index');
        } else {
            return View::make('merchants.show', compact('brand','navigation'));
        }
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


        $brand = Brand::where('user_id', $id)
        ->first();

        if (Merchant::where('brand_id', $id)->exists()) {
            return Redirect::route('retailers.index', $id);
        } 

        return View::make('merchants.show', compact('brand'));
        
    } 


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $merchants  = $request->only(['merchant_type']);
       $brand = Brand::where('user_id', Auth::user()->id)->first();

       $validation = Validator::make($merchants, Merchant::$rules);

       if ($validation->passes()) {
           $input = [];

           foreach ($merchants as $key) 
           {
            $input[] = $key;
        }

        Merchant::insert([
            'brand_id' => $brand->id,
            'merchants' => json_encode($input[0])
            ]);

        return Redirect::route('merchants.show', $brand);
    } else {
        return Redirect::route('brand.index', $brand)->withErrors($validation);

    }
}


public function create()
{
        // If Exists

    $brand = Brand::where('user_id', Auth::user()->id)
    ->first();

    $merchant = Merchant::select('merchants')
    ->where('brand_id', $brand->id)
    ->get();

    return View::make('merchants.create', compact('merchant'));

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
