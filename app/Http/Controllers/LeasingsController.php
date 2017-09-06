<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Leasing;
use Auth;
use Session;

class LeasingsController extends Controller
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
    //First methode
    $leasings = DB::table('leasings')->paginate(50);
    return view('leasings.index', ['leasings' => $leasings]);

    //Second methode
    // $leasings = Leasing::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order
    // return view('leasing.index', compact('posts'));
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'leasing' => 'required',
        'address' => 'required',
        'phone' => 'required'
      ]);

      $message = new leasing;
      $message->leasing = $request->input('leasing');
      $message->address = $request->input('address');
      $message->phone = $request->input('phone');

      $message->save();

      //Display a successful message upon save
      return redirect()->route('leasings.index')->with('flash_message', 'Leasing, '. $message->leasing.' created');

      //return redirect('/leasings');
  }

  public function create(){
    return view('leasings.create');
  }

  public function show($id) {
    $leasing = Leasing::findOrFail($id); //Find post of id = $id
    return view ('leasings.show', compact('leasing'));
  }

  public function edit($id) {
    $leasing = Leasing::findOrFail($id);
    return view('leasings.edit', compact('leasing'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
      'leasing' => 'required',
      'address' => 'required',
      'phone' => 'required'
    ]);

    $message = Leasing::findOrFail($id);
    $message->leasing = $request->input('leasing');
    $message->address = $request->input('address');
    $message->phone = $request->input('phone');

    $message->save();

    return redirect()->route('leasings.index')->with('flash_message', 'Leasing, '. $message->leasing.' updated');
  }

  public function destroy($id) {
    $leasing = Leasing::findOrFail($id);
    $leasing->delete();

    return redirect()->route('leasings.index')->with('flash_message', 'Leasing successfully deleted');
  }

}
