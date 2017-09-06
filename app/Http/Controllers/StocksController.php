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

class StocksController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      //$this->middleware(['auth', 'clearance'])->except('index', 'show');
      $this->middleware(['auth', 'isAdmin']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //First methode
    //$stocks = DB::table('stocks')->paginate(50);
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix', 'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc', 'employees.name', 'leasings.leasing')
    ->join('locations', 'locations.id', '=', 'stocks.location_id')
    ->join('vendors', 'vendors.id', '=', 'stocks.vendor_id')
    ->join('units', 'units.id', '=', 'stocks.unit_id')
    ->join('colors', 'colors.id', '=', 'stocks.color_id')
    ->join('positions', 'positions.id', '=', 'stocks.position_id')
    ->join('positions as alocations', 'alocations.id', '=', 'stocks.alocation_id')
    ->join('user_has_sellers', 'user_has_sellers.id', '=', 'stocks.seller_id')
    ->join('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
    ->join('leasings', 'leasings.id', '=', 'stocks.leasing_id')
    ->paginate(50);
    
    //$locations = DB::table('stocks')
    //->select('locations.location')
    //->join('locations', 'locations.id', '=', 'stocks.location_id');
    //$vendors = DB::table('stocks')
    //->select('vendors.vendor')
    //->join('vendors', 'vendors.id', '=', 'stocks.vendor_id');
    //$stocks = $locations
    //->union($vendors)
    //->paginate(50);
    
    return view('stocks.index', ['stocks' => $stocks]);

    //Second methode
    // $stocks = Stock::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order
    // return view('stock.index', compact('posts'));
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'po_number' => 'required',
        'po_date' => 'required',
        'po_csi' => 'required'
      ]);

      $message = new stock;
      $message->po_number = $request->input('po_number');
      $message->po_date = $request->input('po_date');
      $message->po_csi = $request->input('po_csi');
      $message->location_id = $request->input('location_id');
      $message->vendor_id = $request->input('vendor_id');
      $message->unit_id = $request->input('unit_id');
      $message->chassis = $request->input('chassis');
      $message->engine = $request->input('engine');
      $message->color_id = $request->input('color_id');
      $message->year = $request->input('year');
      $message->position_id = $request->input('position_id');
      $message->alocation_id = $request->input('alocation_id');
      $message->alocation_day = $request->input('alocation_day');
      $message->alocation_date = $request->input('alocation_date');
      $message->seller_id = $request->input('seller_id');
      $message->consumer = $request->input('consumer');
      $message->leasing_id = $request->input('leasing_id');

      $message->save();

      //Display a successful message upon save
      return redirect()->route('stocks.index')->with('flash_message', 'Stock, '. $message->stock.' created');

      //return redirect('/stocks');
  }

  public function create(){
    $locations = Location::pluck('location', 'id');
    $vendors = Vendor::pluck('vendor', 'id');
    $units = Unit::all();
    $colors = Color::all();
    $positions = Position::pluck('position', 'id');
    $leasings = Leasing::pluck('leasing', 'id');
    $marketings = DB::table('marketing_groups')
        ->select('marketing_groups.*', 'employees.name')
        ->join('employees', 'employees.id', '=', 'marketing_groups.spv_id')
        ->get();
    $userHasSellers = DB::table('user_has_sellers')
        ->select('user_has_sellers.*', 'employees.name AS seller', 'supervisors.name AS supervisor')
        ->join('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
        ->join('marketing_groups', 'marketing_groups.id', '=', 'user_has_sellers.marketing_id')
        ->join('employees AS supervisors', 'supervisors.id', '=', 'marketing_groups.spv_id')
        ->get();
    
    return view('stocks.create', compact('locations', 'vendors', 'units', 'colors', 'positions', 'userHasSellers', 'marketings', 'leasings'));
  }

  public function show($id) {
    $stock = Stock::findOrFail($id); //Find post of id = $id
    return view ('stocks.show', compact('stock'));
  }

  public function edit($id) {
    $stock = Stock::findOrFail($id);
    $locations = Location::pluck('location', 'id');
    $vendors = Vendor::pluck('vendor', 'id');
    $units = Unit::all();
    $colors = Color::all();
    $positions = Position::pluck('position', 'id');
    $alocations = Position::pluck('position', 'id');
    $marketings = DB::table('marketing_groups')
        ->select('marketing_groups.*', 'employees.name')
        ->join('employees', 'employees.id', '=', 'marketing_groups.spv_id')
        ->get();
    $userHasSellers = DB::table('user_has_sellers')
        ->select('user_has_sellers.*', 'employees.name AS seller', 'supervisors.name AS supervisor')
        ->join('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
        ->join('marketing_groups', 'marketing_groups.id', '=', 'user_has_sellers.marketing_id')
        ->join('employees AS supervisors', 'supervisors.id', '=', 'marketing_groups.spv_id')
        ->get();
    $leasings = Leasing::pluck('leasing', 'id');
    return view('stocks.edit', compact('stock', 'locations', 'vendors', 'units', 'colors', 'positions', 'alocations', 'userHasSellers', 'marketings', 'leasings'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
        'po_number' => 'required',
        'po_date' => 'required',
        'po_csi' => 'required'
    ]);

        $message = Stock::findOrFail($id);
        $message->po_number = $request->input('po_number');
        $message->po_date = $request->input('po_date');
        $message->po_csi = $request->input('po_csi');
        $message->location_id = $request->input('location_id');
        $message->vendor_id = $request->input('vendor_id');
        $message->unit_id = $request->input('unit_id');
        $message->chassis = $request->input('chassis');
        $message->engine = $request->input('engine');
        $message->color_id = $request->input('color_id');
        $message->year = $request->input('year');
        $message->position_id = $request->input('position_id');
        $message->alocation_id = $request->input('alocation_id');
        $message->alocation_day = $request->input('alocation_day');
        $message->alocation_date = $request->input('alocation_date');
        $message->seller_id = $request->input('seller_id');
        $message->consumer = $request->input('consumer');
        $message->leasing_id = $request->input('leasing_id');

        $message->save();

    return redirect()->route('stocks.index')->with('flash_message', 'Stock, '. $message->stock.' updated');
  }

  public function destroy($id) {
    $stock = Stock::findOrFail($id);
    $stock->delete();

    return redirect()->route('stocks.index')->with('flash_message', 'Stock successfully deleted');
  }

}
