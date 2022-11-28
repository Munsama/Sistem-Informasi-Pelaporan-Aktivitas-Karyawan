<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Account;
use App\Position;
use App\Department;
use App\Leader;
use App\Role;
use Validator;
use Hash;
use MatchOldPassword;
use Response;
use Validate;
// use Image;

class ProfileController extends Controller
{
    //
    public function edit_profile()
    {
        $pos = Position::all();
        $dept = Department::all();
        $lead = Leader::all();
        
        

        return view ('edit_profile', compact('pos', 'dept', 'lead'), array ('user'=>Auth::user()));
    }

    public function editprofil (Request $request)
    {

        $rules = array(
            'name'          => 'required',
            'NIK'           => 'required',
            'position'      => '',
            'department'    => '',
            'leader'        => '',
            

            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
    

        $form_data = array(
            'name'          =>  $request->name,
            'NIK'           =>  $request->NIK,
            'position_id'   =>  $request->position,
            'department_id' =>  $request->department,
            'leader_id'     =>  $request->leader,
            
            
        );
        Account::whereId($request->hidden_id)->update($form_data);

        return  redirect()->back()->with(['success' => 'Data is successfully updated']);
            
        
    }

    public function change_password(){
        return view ('change_password');
    }

    public function updatePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

}
