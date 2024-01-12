<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function edit_user()
    {
        $salaries = \App\Models\Salary::all();
        return view('user_edit',compact('salaries'));
    }

    public function update_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'gender' => 'required',
            'salary_id' => 'required',
            'profile_photo' => 'max:2048',
            'email' => 'required|string|email|max:255',
       
        ]);

        if ($validator->fails()) {
            return redirect(route('edit.user'))
                        ->withErrors($validator)
                        ->withInput();
        }

   
        $user = \App\Models\User::find(\Auth::user()->id);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->salary_id = $request->input('salary_id');
        $user->password = bcrypt($request->input('password'));

     
        if($request->file('profile_photo'))
        {
            $path = public_path('users/profile_photo/');

            $file = $request->file('profile_photo');
            $extension = $file->extension(); 

            $imageName = time() . '.' . $extension;
            $request->profile_photo->move($path, $imageName);
            
            $user->profile_photo = 'users/profile_photo/'.$imageName;
        }

        $user->save();

        Session::flash('status', 'Your profile updated successfully.');
        return redirect()->back();
    }

    public function update_user_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
         
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect(route('edit.user'))
                        ->withErrors($validator)
                        ->withInput();
        }

   
        $user = \App\Models\User::find(\Auth::user()->id);
        $user->password = bcrypt($request->input('password'));
        $user->save();

        Session::flash('status', 'Your password updated successfully.');
        return redirect()->back();
    }

}
