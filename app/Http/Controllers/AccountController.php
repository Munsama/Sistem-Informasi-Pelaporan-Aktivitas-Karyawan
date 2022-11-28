<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Account;
use App\Position;
use App\Department;
use App\Leader;
use App\Role;
use Hash;
use Validator;

class AccountController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
    

        public function index()
        {
            $pos = Position::all();
            $dept = Department::all();
            $lead = Leader::all();
            $rl = Role::all();
            
            if(request()->ajax())
            {
                
                return datatables()
                        ->of(Account::leftjoin('positions', 'users.position_id','=','positions.id')
                        ->leftjoin('departments', 'users.department_id','=','departments.id')
                        ->leftjoin('leaders', 'users.leader_id','=','leaders.id')
                        ->join('roles', 'users.role_id','=','roles.id')
                        ->select('users.id','users.name','users.NIK','users.password','users.position_id','users.department_id','users.leader_id','users.role_id',
                        'positions.position_name','departments.department_name','leaders.leader_name','roles.role_name')
                        ->get())
                        ->addIndexColumn()
                        ->addColumn('action', function($data){
                            $button = '<button type="button" name="edit" id="'.$data->id.'
                            " class="edit btn btn-primary btn-sm  ">Edit</button>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'
                            " class="delete btn btn-danger btn-sm">Delete</button>';
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            
            return view('accounts', compact('pos', 'dept', 'lead', 'rl'));
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
            $rules = array(
                'name'          => ['required', 'string', 'max:255'],
                'NIK'           => ['required', 'string', 'min:8','max:8'],
                'password'      => ['required', 'string', 'min:8'],
                'position'      => '',
                'department'    => '',
                'leader'        => '',
                'role'          => 'required',
            
            );
    
            $error = Validator::make($request->all(), $rules);
    
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
            
            $form_data = array(
                'name'          =>  $request->name,
                'NIK'           =>  $request->NIK,
                'password'      =>  Hash::make($request->password),
                'position_id'   =>  $request->position,
                'department_id' =>  $request->department,
                'leader_id'     =>  $request->leader,
                'role_id'       =>  $request->role,
                
            );
    
            Account::create($form_data);
    
            return response()->json(['success' => 'Data Added successfully.']);
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
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            if(request()->ajax())
            {
                $data = Account::findOrFail($id);
                return response()->json(['data' => $data]);
            }
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
                'name'          => ['required', 'string', 'max:255'],
                'NIK'           => ['required', 'string', 'max:8'],
                'password'      => ['required', 'string', 'min:8'],
                'position'      => '',
                'department'    => '',
                'leader'        => '',
                'role'          => 'required',

                );
    
                $error = Validator::make($request->all(), $rules);
    
                if($error->fails())
                {
                    return response()->json(['errors' => $error->errors()->all()]);
                }
        
    
            $form_data = array(
                'name'          =>  $request->name,
                'NIK'           =>  $request->NIK,
                'password'      =>  Hash::make($request->password),
                'position_id'   =>  $request->position,
                'department_id' =>  $request->department,
                'leader_id'     =>  $request->leader,
                'role_id'       =>  $request->role,
                
            );
            Account::whereId($request->hidden_id)->update($form_data);
    
            return response()->json(['success' => 'Data is successfully updated']);
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $data = Account::findOrFail($id);
            $data->delete();
        }
    }

