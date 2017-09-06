<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Position;

class PositionController extends Controller
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
      $positions = DB::table('positions')->paginate(50);

      return view('positions.index', ['positions' => $positions]);
      //  return view('position');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'position' => 'required',
        ]);

        $message = new position;
        $message->position = $request->input('position');
        $message->save();

        //Display a successful message upon save
        return redirect()->route('positions.index')->with('flash_message', 'Position, '. $message->position.' created');

        //return redirect('/positions');
    }

    public function create(){
      return view('positions.create');
    }

    public function show($id) {
      $position = Position::findOrFail($id); //Find post of id = $id
      return view ('positions.show', compact('position'));
    }

    public function edit($id) {
      $position = Position::findOrFail($id);
      return view('positions.edit', compact('position'));
    }

    public function update(Request $request, $id) {
      $this->validate($request, [
        'position' => 'required',
      ]);

      $message = Position::findOrFail($id);
      $message->position = $request->input('position');
      $message->save();

      return redirect()->route('positions.index')->with('flash_message', 'Position, '. $message->position.' updated');
    }

    public function destroy($id) {
      $position = Position::findOrFail($id);
      $position->delete();

      return redirect()->route('positions.index')->with('flash_message', 'Position successfully deleted');
    }
}
