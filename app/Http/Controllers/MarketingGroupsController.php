<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\MarketingGroup;
use App\Employee;

class MarketingGroupsController extends Controller
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
        $marketingGroups = DB::table('marketing_groups')
        ->select('marketing_groups.*', 'employees.name AS spv')
        ->join('employees', 'employees.id', '=', 'marketing_groups.spv_id')
        ->paginate(50);

        return view('marketingGroups.index', ['marketingGroups' => $marketingGroups]);
        //  return view('marketingGroup');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'spv_id' => 'required',
        ]);

        $message = new MarketingGroup;
        $message->name = $request->input('name');
        $message->spv_id = $request->input('spv_id');
        $message->save();

        //Display a successful message upon save
        return redirect()->route('marketingGroups.index')->with('flash_message', 'Marketing Group, '. $message->name.' created');

        //return redirect('/marketingGroups');
    }

    public function create(){
        $employees = Employee::where('position', 'Supervisor')->pluck('name', 'id');
        return view('marketingGroups.create', compact('employees'));
    }

    public function show($id) {
      //$marketingGroup = MarketingGroup::with('employee')->findOrFail($id); //Find post of id = $id
        $marketingGroups = DB::table('marketing_groups')
        ->select('marketing_groups.*', 'employees.name AS spv')
        ->join('employees', 'employees.id', '=', 'marketing_groups.spv_id')
        ->where('marketing_groups.id', '=', $id)
        ->get();
        //$id = DB::table('marketing_groups')
        //->select('employees.id AS employee_id')
        //->join('employees', 'employees.id', '=', 'marketing_groups.spv_id')
        //->where('marketing_groups.id', '=', $id)
        //->first();
        $sellers = DB::table('user_has_sellers')
        ->select('employees.name', 'employees.position', 'user_has_sellers.id AS uhs_id', 'user_has_sellers.created_at')
        ->join('marketing_groups', 'marketing_groups.id', '=', 'user_has_sellers.marketing_id')
        ->join('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
        ->where('marketing_groups.id', $id)
        ->get();
        
        $employees = DB::table('employees')
        ->where('position', 'Sales')
        ->get();
      return view ('marketingGroups.show', compact('marketingGroups', 'sellers', 'employees'));
    }

    public function edit($id) {
      $marketingGroup = MarketingGroup::findOrFail($id);
      $employees = Employee::where('position', 'Supervisor')->pluck('name', 'id');
      return view('marketingGroups.edit', compact('marketingGroup', 'employees'));
    }

    public function update(Request $request, $id) {
      $this->validate($request, [
        'name' => 'required',
        'spv_id' => 'required',
      ]);

        $message = MarketingGroup::findOrFail($id);
        $message->name = $request->input('name');
        $message->spv_id = $request->input('spv_id');
        $message->save();

      return redirect()->route('marketingGroups.index')->with('flash_message', 'MarketingGroup, '. $message->name.' updated');
    }

    public function destroy($id) {
      $marketingGroup = MarketingGroup::findOrFail($id);
      $marketingGroup->delete();

      return redirect()->route('marketingGroups.index')->with('flash_message', 'MarketingGroup successfully deleted');
    }
}
