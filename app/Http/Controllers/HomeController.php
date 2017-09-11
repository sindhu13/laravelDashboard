<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Location;
use App\Vendor;
use App\Unit;
use App\Color;
use App\Position;
use App\Seller;
use App\Leasing;
use App\Stock;
use Auth;
use Session;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      //$this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function home()
  {
    $tst = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where('last_status_id', '<>', 4)->where('stocks.last_status_id', '<>', 3)->pluck('tot');
    $tsp = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where('status_id', 1)->pluck('tot');
    $tsdo = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where('last_status_id', 4)->pluck('tot');
    $tsdou = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where('last_status_id', 3)->pluck('tot');
    
    return view('/home', ['tst' => $tst, 'tsp' => $tsp, 'tsdo' => $tsdo, 'tsdou' => $tsdou]);

  }
  
  public function homeDo()
  {    
    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where('last_status_id', 4)->pluck('tot');
    
    return view('/do', ['ts' => $ts]);

  }
  
  public function homeSupply()
  {    
    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where('status_id', 1)->pluck('tot');
    
    return view('/supply', ['ts' => $ts]);

  }
  
  public function homeBarter()
  {
    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where('last_status_id', 3)->pluck('tot');
    
    return view('/barter', ['ts' => $ts]);

  }
  
  public function homeIframe()
  {
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix',
             'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc',
             'employees.name', 'leasings.leasing', 'statuses.name AS status')
    ->leftjoin('locations', 'locations.id', '=', 'stocks.location_id')
    ->leftjoin('vendors', 'vendors.id', '=', 'stocks.vendor_id')
    ->leftjoin('units', 'units.id', '=', 'stocks.unit_id')
    ->leftjoin('colors', 'colors.id', '=', 'stocks.color_id')
    ->leftjoin('positions', 'positions.id', '=', 'stocks.position_id')
    ->leftjoin('positions as alocations', 'alocations.id', '=', 'stocks.alocation_id')
    ->leftjoin('user_has_sellers', 'user_has_sellers.id', '=', 'stocks.seller_id')
    ->leftjoin('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
    ->leftjoin('leasings', 'leasings.id', '=', 'stocks.leasing_id')
    ->leftjoin('statuses', 'statuses.id', '=', 'stocks.status_id')
    ->where('stocks.last_status_id', '<>', 4)->where('stocks.last_status_id', '<>', 3)
    ->paginate(50);
    
    return view('/homeIframe', ['stocks' => $stocks]);

  }
  
  public function doIframe()
  {
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix',
             'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc',
             'employees.name', 'leasings.leasing', 'statuses.name AS status')
    ->leftjoin('locations', 'locations.id', '=', 'stocks.location_id')
    ->leftjoin('vendors', 'vendors.id', '=', 'stocks.vendor_id')
    ->leftjoin('units', 'units.id', '=', 'stocks.unit_id')
    ->leftjoin('colors', 'colors.id', '=', 'stocks.color_id')
    ->leftjoin('positions', 'positions.id', '=', 'stocks.position_id')
    ->leftjoin('positions as alocations', 'alocations.id', '=', 'stocks.alocation_id')
    ->leftjoin('user_has_sellers', 'user_has_sellers.id', '=', 'stocks.seller_id')
    ->leftjoin('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
    ->leftjoin('leasings', 'leasings.id', '=', 'stocks.leasing_id')
    ->leftjoin('statuses', 'statuses.id', '=', 'stocks.status_id')
    ->where('stocks.last_status_id', '=', 4)
    ->paginate(50);
    
    return view('/doIframe', ['stocks' => $stocks]);

  }
  
  public function supplyIframe()
  {
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix',
             'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc',
             'employees.name', 'leasings.leasing', 'statuses.name AS status')
    ->leftjoin('locations', 'locations.id', '=', 'stocks.location_id')
    ->leftjoin('vendors', 'vendors.id', '=', 'stocks.vendor_id')
    ->leftjoin('units', 'units.id', '=', 'stocks.unit_id')
    ->leftjoin('colors', 'colors.id', '=', 'stocks.color_id')
    ->leftjoin('positions', 'positions.id', '=', 'stocks.position_id')
    ->leftjoin('positions as alocations', 'alocations.id', '=', 'stocks.alocation_id')
    ->leftjoin('user_has_sellers', 'user_has_sellers.id', '=', 'stocks.seller_id')
    ->leftjoin('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
    ->leftjoin('leasings', 'leasings.id', '=', 'stocks.leasing_id')
    ->leftjoin('statuses', 'statuses.id', '=', 'stocks.status_id')
    ->where('stocks.status_id', '=', 1)
    ->paginate(50);
    
    return view('/supplyIframe', ['stocks' => $stocks]);

  }
  
  public function barterIframe()
  {
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix',
             'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc',
             'employees.name', 'leasings.leasing', 'statuses.name AS status')
    ->leftjoin('locations', 'locations.id', '=', 'stocks.location_id')
    ->leftjoin('vendors', 'vendors.id', '=', 'stocks.vendor_id')
    ->leftjoin('units', 'units.id', '=', 'stocks.unit_id')
    ->leftjoin('colors', 'colors.id', '=', 'stocks.color_id')
    ->leftjoin('positions', 'positions.id', '=', 'stocks.position_id')
    ->leftjoin('positions as alocations', 'alocations.id', '=', 'stocks.alocation_id')
    ->leftjoin('user_has_sellers', 'user_has_sellers.id', '=', 'stocks.seller_id')
    ->leftjoin('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
    ->leftjoin('leasings', 'leasings.id', '=', 'stocks.leasing_id')
    ->leftjoin('statuses', 'statuses.id', '=', 'stocks.status_id')
    ->where('stocks.last_status_id', '=', 3)
    ->paginate(50);
    
    return view('/barterIframe', ['stocks' => $stocks]);

  }

}
