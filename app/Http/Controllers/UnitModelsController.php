<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\UnitModel;

class UnitModelsController extends Controller
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
      $unitModels = DB::table('unit_models')->paginate(50);

      return view('unitModels.index', ['unitModels' => $unitModels]);
      //  return view('unitModel');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
        ]);

        $message = new unitModel;
        $message->name = $request->input('name');
        $message->save();

        //Display a successful message upon save
        return redirect()->route('unitModels.index')->with('flash_message', 'UnitModel, '. $message->unitModel.' created');

        //return redirect('/unitModels');
    }

    public function create(){
      return view('unitModels.create');
    }

    public function show($id) {
      $unitModel = UnitModel::findOrFail($id); //Find post of id = $id
      return view ('unitModels.show', compact('unitModel'));
    }

    public function edit($id) {
      $unitModel = UnitModel::findOrFail($id);
      return view('unitModels.edit', compact('unitModel'));
    }

    public function update(Request $request, $id) {
      $this->validate($request, [
        'name' => 'required',
      ]);

      $message = UnitModel::findOrFail($id);
      $message->name = $request->input('name');
      $message->save();

      return redirect()->route('unitModels.index')->with('flash_message', 'Unit Model, '. $message->unitModel.' updated');
    }

    public function destroy($id) {
      $unitModel = UnitModel::findOrFail($id);
      $unitModel->delete();

      return redirect()->route('unitModels.index')->with('flash_message', 'UnitModel successfully deleted');
    }
}
