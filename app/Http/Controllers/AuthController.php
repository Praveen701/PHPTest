<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegistrationForm()
    {
        $salaries = \App\Models\Salary::all();
        return view('auth.register',compact('salaries'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'gender' => 'required',
            'salary_id' => 'required',
            'profile_photo' => 'required|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }

   
        $user = new \App\Models\User;
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



        Auth::login($user);

        return redirect('/home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
