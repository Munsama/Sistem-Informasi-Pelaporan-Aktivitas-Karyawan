<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Account;
use App\Activity;
use Auth;
use QueryBuilder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employee = Account::where('role_id','2')->count();
        $leader = Account::where('role_id', '3')->count();
        $act = Activity::count();
        $pending = Activity::where('efficiency_id', null)->count();

        $act_emp = Activity::where('activities.user_id', Auth::id())->count();
        $pending_emp = Activity::where('activities.user_id', Auth::id())
                                ->where('efficiency_id', null)->count();
        $avg_effi = Activity::where('activities.user_id', Auth::id())
                            ->avg('efficiency_id');
        $avg_comp = Activity::where('activities.user_id', Auth::id())
                            ->avg('competency_id');

        $act_lead = Activity::join('users', 'activities.user_id','=','users.id')
                            ->join('leaders', 'users.leader_id','=','leaders.id')
                            ->where('leaders.leader_name', Auth::user()->name)
                            ->count('activities.id');

        $pending_lead = Activity::join('users', 'activities.user_id','=','users.id')
                            ->join('leaders', 'users.leader_id','=','leaders.id')
                            ->where('leaders.leader_name', Auth::user()->name)
                            ->where('activities.efficiency_id', null)
                            ->count('activities.id');

        $effi = Activity::join('users', 'activities.user_id','=','users.id')
                            ->join('leaders', 'users.leader_id','=','leaders.id')
                            ->selectRaw('users.name, avg(efficiency_id) as avg_effi')
                            ->where('leaders.leader_name', Auth::user()->name)
                            ->groupBy('users.name')
                            ->orderBy('avg_effi', 'desc')
                            ->first();
        
        // $best_effi = $effi->avg_effi;
        // $be_name = $effi->name;

        $comp = Activity::join('users', 'activities.user_id','=','users.id')
                            ->join('leaders', 'users.leader_id','=','leaders.id')
                            ->selectRaw('users.name, avg(competency_id) as avg_comp')
                            ->where('leaders.leader_name', Auth::user()->name)
                            ->groupBy('users.name')
                            ->orderBy('avg_comp', 'desc')
                            ->first();

        // $best_comp = $comp->avg_comp;
        // $bc_name = $comp->name;                   

        return view('home', compact('employee','leader','act', 'pending','act_emp', 'pending_emp','avg_effi', 'avg_comp','act_lead','pending_lead', 'effi', 'comp', 'be_name', 'bc_name'));
    }
}
