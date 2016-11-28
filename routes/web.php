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
  return view('site.index');
});

Route::get('/documentation', function () {
  return view('site.documentation');
});

Auth::routes();
//Route::get('/home', 'HomeController@index');


/*
| Proxy Routes / Resources
|--------------------------------------------------------------------------
|
*/
Route::get('app/',[
  'as' => 'proxy_index',
  'uses' => 'ProxyController@index']);

  // Geo-graphical Listings


    // Geo-graphical Listings
   

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
Route::get(
    '/dashboard',
    'DashboardController@index'
)->name('carter.dashboard');


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


/*
| CSV Import
|--------------------------------------------------------------------------
|
*/
Route::get('/import',[
  'as' => 'import',
  'uses' => 'ImportController@index']);
Route::post('/import-retailers',[
  'as' => 'import_retailers',
  'uses' => 'ImportController@retailers']);

Route::post('/import-locations',[
  'as' => 'import_locations',
  'uses' => 'ImportController@locations']);



/*
| CSV Export
|--------------------------------------------------------------------------
|
*/
Route::get('/export',[
  'as' => 'export',
  'uses' => 'ExportController@index']);

Route::get('/export-retailers',[
  'as' => 'export_retailers',
  'uses' => 'ExportController@retailers']);

Route::get('/export-locations',[
  'as' => 'export_locations',
  'uses' => 'ExportController@locations']);
