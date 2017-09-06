<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Employee;

class EmployeesController extends Controller
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
      $employees = DB::table('employees')->paginate(50);

      return view('employees.index', ['employees' => $employees]);
      //  return view('employee');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'phone' => 'required',
          'address' => 'required',
          'position' => 'required',
        ]);

        $message = new Employee;
        $message->name = $request->input('name');
        $message->phone = $request->input('phone');
        $message->address = $request->input('address');
        $message->position = $request->input('position');
        $message->save();

        //Display a successful message upon save
        return redirect()->route('employees.index')->with('flash_message', 'Employee, '. $message->name.' created');

        //return redirect('/employees');
    }

    public function create(){
      return view('employees.create');
    }

    public function show($id) {
      $employee = Employee::findOrFail($id); //Find post of id = $id
      return view ('employees.show', compact('employee'));
    }

    public function edit($id) {
      $employee = Employee::findOrFail($id);
      return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id) {
      $this->validate($request, [
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'position' => 'required',
      ]);

      $message = Employee::findOrFail($id);
      $message->name = $request->input('name');
      $message->phone = $request->input('phone');
      $message->address = $request->input('address');
      $message->position = $request->input('position');
      $message->save();

      return redirect()->route('employees.index')->with('flash_message', 'Employee, '. $message->name.' updated');
    }

    public function destroy($id) {
      $employee = Employee::findOrFail($id);
      $employee->delete();

      return redirect()->route('employees.index')->with('flash_message', 'Employee successfully deleted');
    }
}
