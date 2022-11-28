<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use App\Activity;
use App\Account;
use App\User;
use App\Equipment;
use App\Classification;
use App\Efficiency;
use App\Competency;
use Validator;
use Response;
use Auth;

class ActivityReportController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
    

        public function index(Request $request)
        {
            if (Auth::check() && Auth::user()->role_id == 1)
            {
                if(request()->ajax())
                {
                    if(!empty($request->from_date))
                    {
                        $data = Activity::join('users', 'activities.user_id','=','users.id')
                        ->join('equipment', 'activities.equipment_id','=','equipment.id')
                        ->join('classifications', 'activities.classification_id','=','classifications.id')
                        ->leftjoin('efficiencies', 'activities.efficiency_id','=','efficiencies.id')
                        ->leftjoin('competencies', 'activities.competency_id','=','competencies.id')
                        ->select('activities.id','activities.date','activities.user_id','activities.classification_id',
                        'activities.equipment_id','activities.start_time','activities.finish_time','activities.description',
                        'activities.report','activities.efficiency_id','activities.competency_id','users.name',
                        'classifications.classification_name','equipment.equipment_code','equipment.equipment_name',
                        'efficiencies.efficiency_name','competencies.competency_name')
                        ->whereBetween('activities.date', array($request->from_date, $request->to_date))
                        ->orderby('activities.date','desc')
                        ->get();
                    }
                    else 
                    {
                        $data = Activity::join('users', 'activities.user_id','=','users.id')
                        ->join('equipment', 'activities.equipment_id','=','equipment.id')
                        ->join('classifications', 'activities.classification_id','=','classifications.id')
                        ->leftjoin('efficiencies', 'activities.efficiency_id','=','efficiencies.id')
                        ->leftjoin('competencies', 'activities.competency_id','=','competencies.id')
                        ->select('activities.id','activities.date','activities.user_id','activities.classification_id',
                        'activities.equipment_id','activities.start_time','activities.finish_time','activities.description',
                        'activities.report','activities.efficiency_id','activities.competency_id','users.name',
                        'classifications.classification_name','equipment.equipment_code','equipment.equipment_name',
                        'efficiencies.efficiency_name','competencies.competency_name')
                        ->orderby('activities.date','desc')
                        ->get();
                    }
                
                return datatables()->of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($data)
                        {
                            $button = '<a href="crud_activity_report/view/'.$data->id.'"> 
                            <button type="button" name="view"  id="' . $data->id . '" 
                            class="view btn btn-warning btn-sm  ">View</button> </a>';
                            $button .= '<a href="crud_activity_report/edit/'.$data->id.'"> 
                            <button type="button" name="edit" id="' . $data->id . '" 
                            class=" btn btn-primary btn-sm  ">Edit</button> </a>';   
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
            }
            else
            {
                if(request()->ajax())
                {
                    if(!empty($request->from_date))
                    {
                        $data = Activity::join('users', 'activities.user_id','=','users.id')
                            ->join('leaders', 'users.leader_id','=','leaders.id')
                            ->join('equipment', 'activities.equipment_id','=','equipment.id')
                            ->join('classifications', 'activities.classification_id','=','classifications.id')
                            ->leftjoin('efficiencies', 'activities.efficiency_id','=','efficiencies.id')
                            ->leftjoin('competencies', 'activities.competency_id','=','competencies.id')
                            ->select('activities.id','activities.date','activities.user_id','activities.classification_id',
                            'activities.equipment_id','activities.start_time','activities.finish_time','activities.description',
                            'activities.report','activities.efficiency_id','activities.competency_id','users.name',
                            'classifications.classification_name','equipment.equipment_code','equipment.equipment_name', 
                            'efficiencies.efficiency_name', 'competencies.competency_name')
                            ->where('leaders.leader_name', '=', Auth::user()->name)
                            ->whereBetween('activities.date', array($request->from_date, $request->to_date))
                            ->orderby('activities.date','desc')
                            ->get();
                    }

                    else 
                    {
                        $data = Activity::join('users', 'activities.user_id','=','users.id')
                            ->join('leaders', 'users.leader_id','=','leaders.id')
                            ->join('equipment', 'activities.equipment_id','=','equipment.id')
                            ->join('classifications', 'activities.classification_id','=','classifications.id')
                            ->leftjoin('efficiencies', 'activities.efficiency_id','=','efficiencies.id')
                            ->leftjoin('competencies', 'activities.competency_id','=','competencies.id')
                            ->select('activities.id','activities.date','activities.user_id','activities.classification_id',
                            'activities.equipment_id','activities.start_time','activities.finish_time','activities.description',
                            'activities.report','activities.efficiency_id','activities.competency_id','users.name',
                            'classifications.classification_name','equipment.equipment_code','equipment.equipment_name', 
                            'efficiencies.efficiency_name', 'competencies.competency_name')
                            ->where('leaders.leader_name', '=', Auth::user()->name)
                            ->orderby('activities.date','desc')
                            ->get();
                    }
                    return datatables()->of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($data){
                                $button = '<a href="crud_activity_report/view/'.$data->id.'"> 
                                <button type="button" name="view"  id="' . $data->id . '" 
                                class="view btn btn-warning btn-sm  ">View</button> </a>';
                                $button .= '<a href="crud_activity_report/edit/'.$data->id.'"> 
                                <button type="button" name="edit" id="' . $data->id . '" 
                                class=" btn btn-primary btn-sm  ">Edit</button> </a>';
                                return $button;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
                }
            }
            return view('activity_reports');
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {

        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
            $data = Activity::join('users', 'activities.user_id','=','users.id')
            ->join('equipment', 'activities.equipment_id','=','equipment.id')
            ->join('classifications', 'activities.classification_id','=','classifications.id')
            ->leftjoin('efficiencies', 'activities.efficiency_id','=','efficiencies.id')
            ->leftjoin('competencies', 'activities.competency_id','=','competencies.id')
            ->where('activities.id',$id)->first();
            return view ('view_activity_report', compact ('data'));
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $data = Activity::join('users', 'activities.user_id','=','users.id')
            ->join('equipment', 'activities.equipment_id','=','equipment.id')
            ->join('classifications', 'activities.classification_id','=','classifications.id')
            ->leftjoin('efficiencies', 'activities.efficiency_id','=','efficiencies.id')
            ->leftjoin('competencies', 'activities.competency_id','=','competencies.id')
            ->where('activities.id',$id)->first();

            $class = Classification::all();
            $equip = Equipment::orderby('equipment_code','asc')->get();
            $effi = Efficiency::all();
            $comp = Competency::all();

            return view ('edit_activity_report', compact ('id','data', 'class', 'equip','effi','comp'));
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request)
        {
            
                $rules = array(
                'date'              => 'required',
                'employee'          => 'required',
                'classification'    => 'required',
                'equipment'         => 'required',
                'start'             => 'required',
                'finish'            => 'required',
                'description'       => 'required',
                'report'            => 'required',
                'efficiency'        => 'required',
                'competency'        => 'required',
                );
    
                $error = Validator::make($request->all(), $rules);
    
                if($error->fails())
                {
                    return response()->json(['errors' => $error->errors()->all()]);
                }
        
    
            $form_data = array(
                'date'              =>  $request->date,
                'user_id'           =>  $request->employee,
                'classification_id' =>  $request->classification,
                'equipment_id'      =>  $request->equipment,
                'start_time'        =>  $request->start,
                'finish_time'       =>  $request->finish,
                'description'       =>  $request->description,
                'report'            =>  $request->report,
                'efficiency_id'     =>  $request->efficiency,
                'competency_id'     =>  $request->competency,
                
                
            );
            DB::table('activities')->where('id',$request->id)->update($form_data);
    
            return  redirect()->back()->with(['success' => 'Data is successfully updated']);
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            
        }

        
}