<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\UserHasSeller;
use App\Employee;

class UserHasSellersController extends Controller
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
        $userHasSellers = DB::table('user_has_sellers')
        ->join('user_has_sellers', 'user_has_sellers.id', '=', 'user_has_sellers.marketing_id')
        ->join('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
        ->paginate(50);

        return view('userHasSellers.index', ['userHasSellers' => $userHasSellers]);
        //  return view('userHasSeller');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'employee_id' => 'required',
          'begin_work' => 'required',
        ]);

        $message = new UserHasSeller;
        $message->marketing_id = $request->input('marketing_id');
        $message->employee_id = $request->input('employee_id');
        $message->begin_work = $request->input('begin_work');
        $message->save();

        //Display a successful message upon save
        return redirect()->action('MarketingGroupsController@index', $request->input('marketing_id'))->with('flash_message', 'Marketing Group, '. $message->name.' created');

        //return redirect('/userHasSellers');
    }

    public function create($id){
        $employees = Employee::where('position', 'Sales')->orderBy('name')->pluck('name', 'id');
        return view('userHasSellers.create', compact('employees', 'id'));
    }

    public function show($id) {
      //$userHasSeller = UserHasSeller::with('employee')->findOrFail($id); //Find post of id = $id
        $userHasSellers = DB::table('user_has_sellers')
        ->select('user_has_sellers.*', 'employees.name AS spv')
        ->join('employees', 'employees.id', '=', 'user_has_sellers.spv_id')
        ->where('user_has_sellers.id', '=', $id)
        ->get();
        //$id = DB::table('user_has_sellers')
        //->select('employees.id AS employee_id')
        //->join('employees', 'employees.id', '=', 'user_has_sellers.spv_id')
        //->where('user_has_sellers.id', '=', $id)
        //->first();
        $sellers = DB::table('user_has_sellers')
        ->join('user_has_sellers', 'user_has_sellers.id', '=', 'user_has_sellers.marketing_id')
        ->join('employees', 'employees.id', '=', 'user_has_sellers.employee_id')
        ->where('user_has_sellers.id', $id);
      return view ('userHasSellers.show', compact('userHasSellers', 'sellers'));
    }

    public function edit($id) {
      $userHasSeller = UserHasSeller::findOrFail($id);
      $employees = Employee::where('position', 'Sales')->orderBy('name')->pluck('name', 'id');
      return view('userHasSellers.edit', compact('userHasSeller', 'employees'));
    }

    public function update(Request $request, $id) {
      $this->validate($request, [
            'begin_work' => 'required',
      ]);

        $message = UserHasSeller::findOrFail($id);
        $message->marketing_id = $request->input('marketing_id');
        $message->employee_id = $request->input('employee_id');
        $message->begin_work = $request->input('begin_work');
        $message->end_work = $request->input('end_work');
        $message->save();

      return redirect()->action('MarketingGroupsController@index', $request->input('marketing_id'))->with('flash_message', 'UserHasSeller, '. $message->name.' updated');
    }

    public function destroy($id) {
      $userHasSeller = UserHasSeller::findOrFail($id);
      $m_id = $userHasSeller->marketing_id;
      $userHasSeller->delete();

      return redirect()->action('MarketingGroupsController@index', $m_id)->with('flash_message', 'UserHasSeller successfully deleted');
    }
}
