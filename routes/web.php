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

Route::get('/', function () {
    return view('home');
});
Route::get('/', 'HomeController@home');

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