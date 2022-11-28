<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Activity;
use App\Account;
use App\Department;
use Auth;
use QueryBuilder;

class ResultController extends Controller
{
    //

    public function  index(Request $request)
    {
        
    	 if (Auth::check() && Auth::user()->role_id == 1)
            {
                if(request()->ajax())
                {
                    if (!empty($request->department) && !empty($request->from_date))
                    {
                    $data = Activity::join('users', 'activities.user_id', '=', 'users.id')
                    ->join('departments', 'users.department_id','=','departments.id')
                    ->selectRaw('users.name,  departments.department_name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')
                    ->where('users.department_id', $request->department)
                    ->whereBetween('activities.date', array($request->from_date, $request->to_date))
                    ->groupBy('users.name',  'departments.department_name')
                    ->get();
                    }
                    elseif(!empty($request->from_date))
                    {
                    $data = Activity::join('users', 'activities.user_id', '=', 'users.id')
                    ->join('departments', 'users.department_id','=','departments.id')
                    ->selectRaw('users.name,  departments.department_name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')
                    ->whereBetween('activities.date', array($request->from_date, $request->to_date))
                    ->groupBy('users.name',  'departments.department_name')
                    ->get();
                    }
                    elseif (!empty($request->department))
                    {
                    $data = Activity::join('users', 'activities.user_id', '=', 'users.id')
                    ->join('departments', 'users.department_id','=','departments.id')
                    ->selectRaw('users.name, departments.department_name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')
                    ->where('users.department_id', $request->department)
                    ->groupBy('users.name', 'departments.department_name')
                    ->get();
                    }
                    else
                    {
                    $data = Activity::join('users', 'activities.user_id', '=', 'users.id')
                    ->join('departments', 'users.department_id','=','departments.id')
                    ->selectRaw('users.name,  departments.department_name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')
                    ->groupBy('users.name',  'departments.department_name')
                    ->get();
                    }
                    return datatables()->of($data)
                    ->addIndexColumn()
                    ->make(true);
                }
            }
        else
            {
                if(request()->ajax())
                {
                    if (!empty($request->department) && !empty($request->from_date))
                    {
                    $data = Activity::join('users', 'activities.user_id', '=', 'users.id')
                    ->join('leaders', 'users.leader_id','=','leaders.id')
                    ->join('departments', 'users.department_id','=','departments.id')
                    ->selectRaw('users.name,  departments.department_name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')
                    ->where('leaders.leader_name', '=', Auth::user()->name)
                    ->where('users.department_id', $request->department)
                    ->whereBetween('activities.date', array($request->from_date, $request->to_date))
                    ->groupBy('users.name',  'departments.department_name')
                    ->get();
                    }
                    elseif(!empty($request->from_date))
                    {
                    $data = Activity::join('users', 'activities.user_id', '=', 'users.id')
                    ->join('leaders', 'users.leader_id','=','leaders.id')
                    ->join('departments', 'users.department_id','=','departments.id')
                    ->selectRaw('users.name,  departments.department_name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')
                    ->where('leaders.leader_name', '=', Auth::user()->name)
                    ->whereBetween('activities.date', array($request->from_date, $request->to_date))
                    ->groupBy('users.name',  'departments.department_name')
                    ->get();
                    }
                    elseif (!empty($request->department))
                    {
                    $data = Activity::join('users', 'activities.user_id', '=', 'users.id')
                    ->join('leaders', 'users.leader_id','=','leaders.id')
                    ->join('departments', 'users.department_id','=','departments.id')
                    ->selectRaw('users.name, departments.department_name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')
                    ->where('leaders.leader_name', '=', Auth::user()->name)
                    ->where('users.department_id', $request->department)
                    ->groupBy('users.name', 'departments.department_name')
                    ->get();
                    }
                    else
                    {
                    $data = Activity::join('users', 'activities.user_id', '=', 'users.id')
                    ->join('leaders', 'users.leader_id','=','leaders.id')
                    ->join('departments', 'users.department_id','=','departments.id')
                    ->selectRaw('users.name,  departments.department_name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')
                    ->where('leaders.leader_name', '=', Auth::user()->name)
                    ->groupBy('users.name',  'departments.department_name')
                    ->get();
                    }
                    return datatables()->of($data)
                    ->addIndexColumn()
                    ->make(true);
                }
            }
    	// $result = Activity::join('users', 'activities.user_id', '=', 'users.id')->join('leaders', 'users.leader_id','=','leaders.id')->selectRaw('users.name, count(activities.id) as total_act, sum(efficiency_id) as total_effi,sum(competency_id) as total_comp,avg(efficiency_id) as avg_effi, avg(competency_id) as avg_comp')->where('leaders.leader_name','=', Auth::user()->name)->groupBy('users.name')->get(); 
    	
        $dept =  Department::all();

        // $gt_act = $data->sum('total_act');

    	return view('results', compact('dept', 'gt_act'));
        // compact('employee','total_act', 'total_effi', 'total_comp', 'avg_effi', 'avg_comp')
    }
    
    public function  view()
    {

    }
    
}
