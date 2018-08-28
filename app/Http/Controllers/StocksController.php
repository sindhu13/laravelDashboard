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
use App\Status;
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
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix', 'colors.color',
             'colors.code', 'positions.position', 'alocations.position AS aloc',
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
    ->where(function ($query){
        $search = \Request::get('search');
        $query->where('stocks.chassis', 'like', '%'. $search .'%')
            ->orwhere('stocks.consumer', 'like', '%'. $search .'%');

    })
    ->paginate(200);

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
        'po_csi' => 'required',
        'chassis' => 'required|unique:stocks',
        'engine' => 'required|unique:stocks',
        'unit_id' => 'required',
        'color_id' => 'required',
        'location_id' => 'required',
        'vendor_id' => 'required',
        'status_id' => 'required',
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
      $message->status_id = $request->input('status_id');
      $message->last_status_id = $request->input('status_id');

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
    $status = Status::where('id', 1)->orwhere('id', 2)->pluck('name', 'id');
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

    return view('stocks.create', compact('locations', 'vendors', 'units', 'colors', 'positions',
                                         'userHasSellers', 'marketings', 'leasings', 'status'));
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
    $status = Status::where('id', 3)->orwhere('id', 4)->pluck('name', 'id');
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
    return view('stocks.edit', compact('stock', 'locations', 'vendors', 'units', 'colors',
                                       'positions', 'alocations', 'userHasSellers',
                                       'marketings', 'leasings', 'status'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
        'po_number' => 'required',
        'po_date' => 'required',
        'po_csi' => 'required',
        'unit_id' => 'required',
        'color_id' => 'required',
        'location_id' => 'required',
        'vendor_id' => 'required',
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
        $message->last_pos = $request->input('last_pos');
        $message->last_pos_ho_less = $request->input('last_pos_ho_less');
        $message->last_pos_ho_greater = $request->input('last_pos_ho_greater');
        if($request->input('last_status_id') != ''){
            $message->last_status_id = $request->input('last_status_id');
            $message->status_date = $request->input('status_date');
        }

        $message->save();

    return redirect()->route('stocks.index')->with('flash_message', 'Stock, '. $message->stock.' updated');
  }

  public function destroy($id) {
    $stock = Stock::findOrFail($id);
    $stock->delete();

    return redirect()->route('stocks.index')->with('flash_message', 'Stock successfully deleted');
  }

  public function dos()
  {
    //$search = \Request::get('search');
    $n = \Carbon\Carbon::now();
    $stocks = DB::table('stocks')
    ->select('stocks.*', 'locations.location', 'vendors.vendor', 'units.unit', 'units.suffix', 'colors.color', 'colors.code', 'positions.position', 'alocations.position AS aloc', 'employees.name', 'leasings.leasing')
    ->leftjoin('locations', 'locations.id', '=', 'stocks.location_id')
    ->leftjoin('vendors', 'vendors.id', '=', 'stocks.vendor_id')
    ->leftjoin('units', 'units.id', '=', 'stocks.unit_id')
    ->leftjoin('colors', 'colors.id', '=', 'stocks.color_id')
    ->leftjoin('positions', 'positions.id', '=', 'stocks.position_id')
    ->leftjoin('positions as alocations', 'alocations.id', '=', 'stocks.alocation_id')
    ->leftjoin('user_has_sellers', 'user_has_sellers.id', '=', 'stocks.seller_id')
    ->leftjoin('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
    ->leftjoin('leasings', 'leasings.id', '=', 'stocks.leasing_id')
    ->where('stocks.last_status_id', '=', 4)
    ->where(DB::raw('YEAR(stocks.status_date)'), '=', $n->year)
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

    return view('stocks.dos', ['stocks' => $stocks]);
  }

}
