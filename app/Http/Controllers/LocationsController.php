<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Location;

class LocationsController extends Controller
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
    $locations = DB::table('locations')->paginate(50);

    return view('locations.index', ['locations' => $locations]);
    //  return view('location');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'location' => 'required',
      ]);

      $message = new location;
      $message->location = $request->input('location');
      $message->save();

      //Display a successful message upon save
      return redirect()->route('locations.index')->with('flash_message', 'Location, '. $message->location.' created');

      //return redirect('/locations');
  }

  public function create(){
    return view('locations.create');
  }

  public function show($id) {
    $location = Location::findOrFail($id); //Find post of id = $id
    return view ('locations.show', compact('location'));
  }

  public function edit($id) {
    $location = Location::findOrFail($id);
    return view('locations.edit', compact('location'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
      'location' => 'required',
    ]);

    $message = Location::findOrFail($id);
    $message->location = $request->input('location');
    $message->save();

    return redirect()->route('locations.index')->with('flash_message', 'Location, '. $message->location.' updated');
  }

  public function destroy($id) {
    $location = Location::findOrFail($id);
    $location->delete();

    return redirect()->route('locations.index')->with('flash_message', 'Location successfully deleted');
  }

}
