<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
  //return view('welcome');
//});

//Auth::routes();
//Route::get('/home', 'HomeController@index');


/*
| Proxy Routes / Resources
|--------------------------------------------------------------------------
|
*/
Route::get('app', 'ProxyController@index');

// Merchant Page
//Route::get('/show/{country}', 'ProxyController@show');

// Geo-graphical Listings
//Route::get('app/{country}', 'ProxyController@country');

//Route::get('/search/retailers', 'ProxyController@search');


//Route::get('/proxy/{country}/{state}', 'ProxyController@state');
//
// Retailer Page
//Route::post('/proxy/{country}/{city}/{id}', 'ProxyController@getRetailer');
//Route::get('/{country}/{city}/{slug}', 'ProxyController@retailer');



/*
| Setup / Settings Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('brand', 'BrandController');
Route::resource('merchants', 'MerchantsController');

/*
| Dashboard / Landing Page
|--------------------------------------------------------------------------
|
*/
Route::resource('dashboard', 'DashboardController');


Route::post('dashboard/delete','DashboardController@delete');



/*
| Retailers / RetailersController
|--------------------------------------------------------------------------
|
*/
Route::resource('retailers', 'RetailersController');

/*
| Locations / LocationsController
|--------------------------------------------------------------------------
|
*/
Route::resource('locations', 'LocationsController');

/*
| Addresses / LocationsController
|--------------------------------------------------------------------------
|
*/
Route::get('address/{id}/edit',[
  'as' => 'address_edit', 
  'uses' => 'LocationsController@addressView']);

Route::put('address/{id}',[
  'as' => 'address_save', 
  'uses' => 'LocationsController@addressSave']);

/*
| Image Uploading / Image Resources
|--------------------------------------------------------------------------
|
*/
Route::post('upload/image/{id}',[
  'as' => 'upload_image', 
  'uses' => 'ImagesController@upload']);

Route::delete('upload/{type}/delete/{id}',[
  'as' => 'delete-logo', 
  'uses' => 'ImagesController@deleteLogo']);

/*
| Template Selection / Resources
|--------------------------------------------------------------------------
|
*/
Route::resource('templates', 'TemplatesController');

