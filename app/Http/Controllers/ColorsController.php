<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Color;

class ColorsController extends Controller
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
    $colors = DB::table('colors')->paginate(50);

    return view('colors.index', ['colors' => $colors]);
    //  return view('color');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
        'color' => 'required',
        'code' => 'required',
      ]);

      $message = new color;
      $message->color = $request->input('color');
      $message->code = $request->input('code');
      $message->save();

      //Display a successful message upon save
      return redirect()->route('colors.index')->with('flash_message', 'Color, '. $message->color.' created');

      //return redirect('/colors');
  }

  public function create(){
    return view('colors.create');
  }

  public function show($id) {
    $color = Color::findOrFail($id); //Find post of id = $id
    return view ('colors.show', compact('color'));
  }

  public function edit($id) {
    $color = Color::findOrFail($id);
    return view('colors.edit', compact('color'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
      'color' => 'required',
      'code' => 'required',
    ]);

    $message = Color::findOrFail($id);
    $message->color = $request->input('color');
    $message->code = $request->input('code');
    $message->save();

    return redirect()->route('colors.index')->with('flash_message', 'Color, '. $message->color.' updated');
  }

  public function destroy($id) {
    $color = Color::findOrFail($id);
    $color->delete();

    return redirect()->route('colors.index')->with('flash_message', 'Color successfully deleted');
  }

}
