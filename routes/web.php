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

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();
//Route::get('/home', 'HomeController@index');


/*
| Proxy Routes / Resources
|--------------------------------------------------------------------------
|
*/
Route::get('app',[
  'as' => 'proxy_index',
  'uses' => 'ProxyController@index']);

  // Geo-graphical Listings


    // Geo-graphical Listings
    Route::get('app/{r}', [
      'as' => 'proxy_retailer',
      'uses' => 'ProxyController@retailer']);

// Geo-graphical Listings


 // Geo-graphical Listings
 Route::get('app/{lat}/{lon}/', [
   'as' => 'proxy_origin',
   'uses' => 'ProxyController@origin']);


//Route::get('dashboard', 'DashboardController@index')->name('carter.dashboard');


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
//Route::resource('dashboard', 'DashboardController');


//Route::post('dashboard/delete','DashboardController@delete');



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

Route::post('/import-csv',[
  'as' => 'import_csv',
  'uses' => 'ExportController@import']);

Route::get('/import',[
  'as' => 'import_retailers',
  'uses' => 'ExportController@index']);

Route::get('export/',[
  'as' => 'export_retailers',
  'uses' => 'ExportController@export']);
