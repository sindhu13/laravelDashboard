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
    $n = \Carbon\Carbon::now();
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

    $tst = DB::table('stocks')->select(DB::raw('count(id) AS tot'))
        ->where('last_status_id', '<>', 4)
        ->where('stocks.last_status_id', '<>', 3)
        ->pluck('tot');
    $tsp = DB::table('stocks')->select(DB::raw('count(id) AS tot'))
        ->whereMonth('stocks.po_date', '=', $n->month)
        ->where('status_id', 1)
        ->where(DB::raw('YEAR(stocks.po_date)'), '=', $n->year)
        ->pluck('tot');
    $tsdo = DB::table('stocks')->select(DB::raw('count(id) AS tot'))
        ->whereMonth('stocks.status_date', '=', $n->month)
        ->where('last_status_id', 4)
        ->where(DB::raw('YEAR(stocks.status_date)'), '=', $n->year)
        ->pluck('tot');
    $tsdou = DB::table('stocks')->select(DB::raw('count(id) AS tot'))
        ->whereMonth('stocks.status_date', '=', $n->month)
        ->where('last_status_id', 3)
        ->where(DB::raw('YEAR(stocks.status_date)'), '=', $n->year)
        ->pluck('tot');

    $marketings = DB::table('marketing_groups')->get();
    $sales = DB::table('stocks')
        ->select('marketing_groups.id', 'marketing_groups.name', DB::raw('YEAR(stocks.status_date) AS y'), DB::raw('MONTH(stocks.status_date) AS m'), DB::raw('COUNT(stocks.id) AS tot'))
        ->join('user_has_sellers', 'user_has_sellers.id', 'stocks.seller_id')
        ->join('marketing_groups', 'marketing_groups.id', 'user_has_sellers.marketing_id')
        ->join('employees', 'employees.id', 'marketing_groups.spv_id')
        ->where('stocks.last_status_id', '=', 4)->where(DB::raw('YEAR(stocks.status_date)'), '=', $n->year)
        ->groupBy(DB::raw('YEAR(stocks.status_date)'), DB::raw('MONTH(stocks.status_date)'), 'marketing_groups.id')
        ->get();

    return view('/home', ['stocks' => $stocks, 'tst' => $tst, 'tsp' => $tsp, 'tsdo' => $tsdo, 'tsdou' => $tsdou, 'marketings' => $marketings, 'sales' => $sales]);

  }

  public function homeDo()
  {
    $n = \Carbon\Carbon::now();
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
    ->where('stocks.last_status_id', '=', 4)->where(DB::raw('YEAR(stocks.status_date)'), '=', $n->year)
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

    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where(DB::raw('YEAR(stocks.status_date)'), '=', $n->year)->whereMonth('stocks.status_date', '=', $n->month)->where('last_status_id', 4)->pluck('tot');

    return view('/do', ['stocks' => $stocks, 'ts' => $ts]);

  }

  public function homeSupply()
  {
    $n = \Carbon\Carbon::now();
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
    ->where(DB::raw('YEAR(stocks.po_date)'), '=', $n->year)
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
    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where(DB::raw('YEAR(stocks.po_date)'), '=', $n->year)
      ->whereMonth('stocks.po_date', '=', $n->month)->where('status_id', 1)->pluck('tot');

    return view('/supply', ['stocks' => $stocks, 'ts' => $ts]);

  }

  public function homeBarter()
  {
    $n = \Carbon\Carbon::now();
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
    ->where(DB::raw('YEAR(stocks.po_date)'), '=', $n->year)
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

    $ts = DB::table('stocks')->select(DB::raw('count(id) AS tot'))->where(DB::raw('YEAR(stocks.po_date)'), '=', $n->year)
      ->whereMonth('stocks.status_date', '=', $n->month)->where('last_status_id', 3)->pluck('tot');

    return view('/barter', ['stocks' => $stocks, 'ts' => $ts]);

  }


}
