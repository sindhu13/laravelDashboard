<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Unit;
use App\UnitModel;

class UnitsController extends Controller
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
    $units = DB::table('units')->paginate(50);

    return view('units.index', ['units' => $units]);
    //  return view('unit');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'unit_model_id' => 'required',
        'unit' => 'required',
        'katashiki' => 'required',
        'suffix' => 'required',
      ]);

      $message = new unit;
      $message->unit_model_id = $request->input('unit_model_id');
      $message->unit = $request->input('unit');
      $message->katashiki = $request->input('katashiki');
      $message->suffix = $request->input('suffix');
      $message->save();

      //Display a successful message upon save
      return redirect()->route('units.index')->with('flash_message', 'Unit, '. $message->unit.' created');

      //return redirect('/units');
  }

  public function create(){
    $models = UnitModel::pluck('name', 'id');
    return view('units.create', compact('models'));
  }

  public function show($id) {
    $unit = Unit::findOrFail($id); //Find post of id = $id
    return view ('units.show', compact('unit'));
  }

  public function edit($id) {
    $unit = Unit::findOrFail($id);
    $models = UnitModel::pluck('name', 'id');
    return view('units.edit', compact('unit', 'models'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
      'unit_model_id' => 'required',  
      'unit' => 'required',
      'katashiki' => 'required',
      'suffix' => 'required',
    ]);

    $message = Unit::findOrFail($id);
    $message->unit_model_id = $request->input('unit_model_id');
    $message->unit = $request->input('unit');
    $message->katashiki = $request->input('katashiki');
    $message->suffix = $request->input('suffix');
    $message->save();

    return redirect()->route('units.index')->with('flash_message', 'Unit, '. $message->unit.' updated');
  }

  public function destroy($id) {
    $unit = Unit::findOrFail($id);
    $unit->delete();

    return redirect()->route('units.index')->with('flash_message', 'Unit successfully deleted');
  }

}
