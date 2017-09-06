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
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix', 'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc', 'sellers.name', 'leasings.leasing')
    ->join('locations', 'locations.id', '=', 'stocks.location_id')
    ->join('vendors', 'vendors.id', '=', 'stocks.vendor_id')
    ->join('units', 'units.id', '=', 'stocks.unit_id')
    ->join('colors', 'colors.id', '=', 'stocks.color_id')
    ->join('positions', 'positions.id', '=', 'stocks.position_id')
    ->join('positions as alocations', 'alocations.id', '=', 'stocks.alocation_id')
    ->join('sellers', 'sellers.id', '=', 'stocks.seller_id')
    ->join('leasings', 'leasings.id', '=', 'stocks.leasing_id')
    ->paginate(50);
    
    return view('/home', ['stocks' => $stocks]);

  }

}
