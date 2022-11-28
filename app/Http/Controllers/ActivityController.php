<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use App\Activity;
use App\Account;
use App\Equipment;
use App\Classification;
use Validator;
use Response;
use Auth;

class ActivityController extends Controller
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
                        $data = DB::table('activities')
                        ->join('users', 'activities.user_id','=','users.id')
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
                        $data = DB::table('activities')
                        ->join('users', 'activities.user_id','=','users.id')
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
                            $button = '<a href="crud_activity/view/'.$data->id.'"> <button type="button" name="view"  id="' . $data->id . '" class="view btn btn-warning btn-sm  ">View</button> </a>';
                            $button .= '<a href="crud_activity/edit/'.$data->id.'"> <button type="button" name="edit" id="' . $data->id . '" class=" btn btn-primary btn-sm  ">Edit</button> </a>';
                            $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
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
                        $data = DB::table('activities')
                        ->join('users', 'activities.user_id','=','users.id')
                        ->join('equipment', 'activities.equipment_id','=','equipment.id')
                        ->join('classifications', 'activities.classification_id','=','classifications.id')
                        ->leftjoin('efficiencies', 'activities.efficiency_id','=','efficiencies.id')
                        ->leftjoin('competencies', 'activities.competency_id','=','competencies.id')
                        ->select('activities.id','activities.date','activities.user_id','activities.classification_id',
                        'activities.equipment_id','activities.start_time','activities.finish_time','activities.description',
                        'activities.report','activities.efficiency_id','activities.competency_id','users.name',
                        'classifications.classification_name','equipment.equipment_code','equipment.equipment_name',
                        'efficiencies.efficiency_name','competencies.competency_name')
                        ->where('activities.user_id','=', Auth::id())
                        ->whereBetween('activities.date', array($request->from_date, $request->to_date))
                        ->orderby('activities.date','desc')
                        ->get();
                        }
                        else 
                        {
                        $data = DB::table('activities')
                        ->join('users', 'activities.user_id','=','users.id')
                        ->join('equipment', 'activities.equipment_id','=','equipment.id')
                        ->join('classifications', 'activities.classification_id','=','classifications.id')
                        ->leftjoin('efficiencies', 'activities.efficiency_id','=','efficiencies.id')
                        ->leftjoin('competencies', 'activities.competency_id','=','competencies.id')
                        ->select('activities.id','activities.date','activities.user_id','activities.classification_id',
                        'activities.equipment_id','activities.start_time','activities.finish_time','activities.description',
                        'activities.report','activities.efficiency_id','activities.competency_id','users.name',
                        'classifications.classification_name','equipment.equipment_code','equipment.equipment_name',
                        'efficiencies.efficiency_name','competencies.competency_name')
                        ->where('activities.user_id','=', Auth::id())
                        ->orderby('activities.date','desc')
                        ->get();
                        }

                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($data)
                        {
                            $button = '<a href="crud_activity/view/'.$data->id.'"> <button type="button" name="view"  id="' . $data->id . '" class="view btn btn-warning btn-sm  ">View</button> </a>';
                            $button .= '<a href="crud_activity/edit/'.$data->id.'"> <button type="button" name="edit" id="' . $data->id . '" class=" btn btn-primary btn-sm  ">Edit</button> </a>';
                            $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                            return $button;

                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
            }
            
            return view('activities');
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
            $users = Account::all();
            $class = Classification::all();
            $equip = Equipment::orderby('equipment_code','asc')->get();
            // $effi = Efficiency::all();
            // $comp = Competency::all();

            return view('add_activity', compact('users', 'class', 'equip'));
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
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
                
                
            );
    
            Activity::create($form_data);
    
            return redirect()->route('act')->with(['success' => 'Data is successfully added']);
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
            $data = DB::table('activities')->join('users', 'activities.user_id','=','users.id')
            ->join('equipment', 'activities.equipment_id','=','equipment.id')
            ->join('classifications', 'activities.classification_id','=','classifications.id')
            ->where('activities.id',$id)->first();

            return view ('view_activity', compact ('data'));
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
            ->where('activities.id',$id)->first();

            $class = Classification::all();
            $equip = Equipment::orderby('equipment_code','asc')->get();

            return view ('edit_activity', compact ('id','data', 'class', 'equip'));
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
            $data = Activity::findOrFail($id);
            $data->delete();
        }

        public function upload_desc(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function upload_rprt(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

}