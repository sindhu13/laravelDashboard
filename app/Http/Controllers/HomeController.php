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
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix',
             'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc',
             'employees.name', 'leasings.leasing', 'statuses.name AS status', 'lstat.name AS lstat')
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
    ->leftjoin('statuses AS lstat', 'lstat.id', '=', 'stocks.last_status_id')
    ->where('stocks.last_status_id', '<>', 4)->where('stocks.last_status_id', '<>', 3)
    ->where(function ($query){
        $search = \Request::get('search');
        $query->where('stocks.chassis', 'like', '%'. $search .'%')
            ->orwhere('stocks.consumer', 'like', '%'. $search .'%');
        
    })
    ->paginate(200);
    $n = \Carbon\Carbon::now();
    $tst = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where('last_status_id', '<>', 4)->where('stocks.last_status_id', '<>', 3)->pluck('tot');
    $tsp = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->whereMonth('stocks.po_date', '=', $n->month)->where('status_id', 1)->pluck('tot');
    $tsdo = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->whereMonth('stocks.status_date', '=', $n->month)->where('last_status_id', 4)->pluck('tot');
    $tsdou = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->whereMonth('stocks.status_date', '=', $n->month)->where('last_status_id', 3)->pluck('tot');
    
    return view('/home', ['stocks' => $stocks, 'tst' => $tst, 'tsp' => $tsp, 'tsdo' => $tsdo, 'tsdou' => $tsdou]);

  }
  
  public function homeDo()
  {
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix',
             'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc',
             'employees.name', 'leasings.leasing', 'statuses.name AS status', 'lstat.name AS lstat')
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
    ->leftjoin('statuses AS lstat', 'lstat.id', '=', 'stocks.last_status_id')
    ->where('stocks.last_status_id', '=', 4)
    ->where(function ($query){
        $search = \Request::get('search');
        $month = \Request::get('monthsearch');
        if(isset($search)){
            $query->where('stocks.chassis', 'like', '%'. $search .'%')
                ->orwhere('stocks.consumer', 'like', '%'. $search .'%');
        }elseif(isset($month)){
            $query->whereMonth('stocks.status_date', '=', $month);
        }else{
            $n = \Carbon\Carbon::now();
            $query->whereMonth('stocks.status_date', '=', $n->month);
        }
    })
    ->paginate(200);
    $n = \Carbon\Carbon::now();
    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->whereMonth('stocks.status_date', '=', $n->month)->where('last_status_id', 4)->pluck('tot');
    
    return view('/do', ['stocks' => $stocks, 'ts' => $ts]);

  }
  
  public function homeSupply()
  {
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix',
             'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc',
             'employees.name', 'leasings.leasing', 'statuses.name AS status', 'lstat.name AS lstat')
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
    ->leftjoin('statuses AS lstat', 'lstat.id', '=', 'stocks.last_status_id')
    ->where('stocks.status_id', '=', 1)
    ->where(function ($query){
        $search = \Request::get('search');
        $month = \Request::get('monthsearch');
        if(isset($search)){
            $query->where('stocks.chassis', 'like', '%'. $search .'%')
                ->orwhere('stocks.consumer', 'like', '%'. $search .'%');
        }elseif(isset($month)){
            $query->whereMonth('stocks.po_date', '=', $month);
        }else{
            $n = \Carbon\Carbon::now();
            $query->whereMonth('stocks.po_date', '=', $n->month);
        }
    })
    ->paginate(200);
    $n = \Carbon\Carbon::now();
    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->whereMonth('stocks.po_date', '=', $n->month)->where('status_id', 1)->pluck('tot');
    
    return view('/supply', ['stocks' => $stocks, 'ts' => $ts]);

  }
  
  public function homeBarter()
  {
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix',
             'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc',
             'employees.name', 'leasings.leasing', 'statuses.name AS status', 'lstat.name AS lstat')
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
    ->leftjoin('statuses AS lstat', 'lstat.id', '=', 'stocks.last_status_id')
    ->where('stocks.last_status_id', '=', 3)
    ->where(function ($query){
        $search = \Request::get('search');
        $month = \Request::get('monthsearch');
        if(isset($search)){
            $query->where('stocks.chassis', 'like', '%'. $search .'%')
                ->orwhere('stocks.consumer', 'like', '%'. $search .'%');
        }elseif(isset($month)){
            $query->whereMonth('stocks.status_date', '=', $month);
        }else{
            $n = \Carbon\Carbon::now();
            $query->whereMonth('stocks.status_date', '=', $n->month);
        }
    })
    ->paginate(200);
    $n = \Carbon\Carbon::now();
    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->whereMonth('stocks.status_date', '=', $n->month)->where('last_status_id', 3)->pluck('tot');
    
    return view('/barter', ['stocks' => $stocks, 'ts' => $ts]);

  }
  

}
