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
Route::get('app',[
  'as' => 'proxy_index',
  'uses' => 'ProxyController@index']);


 // Geo-graphical Listings
 Route::get('app/{lat}/{lon}', [
   'as' => 'proxy_origin',
   'uses' => 'ProxyController@origin']);


   Route::get('app/{retailer}',[
     'as' => 'proxy_retailer',
     'uses' => 'ProxyController@retailer']);

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



/*
| Retailers / RetailersController
|--------------------------------------------------------------------------
|
*/

Route::resource('retailers', 'RetailersController',['except' => ['destroy','destroyAll','getMeta']]);

Route::any('retailers/delete/{id}',[
  'as' => 'retailer_delete',
  'uses' => 'RetailersController@destroy']);

Route::any('retailers/delete-all',[
  'as' => 'retailer_all_delete',
  'uses' => 'RetailersController@destroyAll']);

  Route::any('retailers/get-meta',[
    'as' => 'get_meta',
    'uses' => 'RetailersController@getMeta']);
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
  'as' => 'delete_image',
  'uses' => 'ImagesController@delete']);

/*
| Template Selection / Resources
|--------------------------------------------------------------------------
|
*/
Route::resource('templates', 'TemplatesController');


/*
| Settings / Resources
|--------------------------------------------------------------------------
|
*/
Route::resource('settings', 'SettingsController');



/*
| CSV Import
|--------------------------------------------------------------------------
|
*/
Route::get('/import',[
  'as' => 'import',
  'uses' => 'ImportController@index']);


Route::any('/import-retailers',[
  'as' => 'import_retailers',
  'uses' => 'ImportController@retailers']);




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
