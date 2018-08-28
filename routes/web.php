<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
//    return view('home');
//})->middleware('auth');

//Route::get('/', function () {
//    return view('home');
//});
Route::get('/', 'HomeController@home');
Route::get('/home', 'HomeController@home');
Route::get('/do', 'HomeController@homeDo');
Route::get('/supply', 'HomeController@homeSupply');
Route::get('/barter', 'HomeController@homeBarter');
Route::get('/salesperformance', 'HomeController@salesperformance');
Route::get('/detailsales/{y}/{m}/{id}', 'HomeController@detailsales');
Route::get('/salespermodel', 'HomeController@salespermodel');
Route::get('/salespercolor', 'HomeController@salespercolor');
Route::get('/salesperleasing', 'HomeController@salesperleasing');
Route::get('/stockbranch', 'HomeController@stockbranch');

//Route::get('/stocks/dos', 'StocksController@dos');
Route::get('/stocks/dos', ['as' => 'stocks.dos', 'uses' => 'StocksController@dos']);

Auth::routes();

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('leasings', 'LeasingsController');

Route::resource('positions', 'PositionController');

Route::resource('locations', 'LocationsController');

Route::resource('vendors', 'VendorsController');

Route::resource('units', 'UnitsController');

Route::resource('colors', 'ColorsController');

Route::resource('employees', 'EmployeesController');

Route::resource('stocks', 'StocksController');


Route::resource('marketingGroups', 'MarketingGroupsController');
Route::get('/marketingGroups/{id}', 'MarketingGroupsController@index');

Route::resource('userHasSellers', 'UserHasSellersController');
Route::get('/userHasSellers/create/{id}', ['uses' => 'UserHasSellersController@create']);

Route::resource('unitModels', 'UnitModelsController');
