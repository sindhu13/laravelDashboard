<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Vendor;

class VendorsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware(['auth', 'isAdmin']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $vendors = DB::table('vendors')->paginate(50);

    return view('vendors.index', ['vendors' => $vendors]);
    //  return view('vendor');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'vendor' => 'required',
      ]);

      $message = new vendor;
      $message->vendor = $request->input('vendor');
      $message->save();

      //Display a successful message upon save
      return redirect()->route('vendors.index')->with('flash_message', 'Vendor, '. $message->vendor.' created');

      //return redirect('/vendors');
  }

  public function create(){
    return view('vendors.create');
  }

  public function show($id) {
    $vendor = Vendor::findOrFail($id); //Find post of id = $id
    return view ('vendors.show', compact('vendor'));
  }

  public function edit($id) {
    $vendor = Vendor::findOrFail($id);
    return view('vendors.edit', compact('vendor'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
      'vendor' => 'required',
    ]);

    $message = Vendor::findOrFail($id);
    $message->vendor = $request->input('vendor');
    $message->save();

    return redirect()->route('vendors.index')->with('flash_message', 'Vendor, '. $message->vendor.' updated');
  }

  public function destroy($id) {
    $vendor = Vendor::findOrFail($id);
    $vendor->delete();

    return redirect()->route('vendors.index')->with('flash_message', 'Vendor successfully deleted');
  }

}
