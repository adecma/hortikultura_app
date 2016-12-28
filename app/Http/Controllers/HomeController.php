<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use Validator;
use Hash;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('static.home');
    }

    /**
     * Show detail profile user
     * @return \Illuminate\Http\Response 
     */
    public function showProfile()
    {
        $user = User::findOrFail(Auth::user()->id);
        
        return view('profile.show', compact('user'));
    }


    public function editProfile()
    {
        $user = User::findOrFail(Auth::user()->id);
        
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $user = User::findOrFail(Auth::user()->id);

        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, current($parameters));
        }, 'The :attribute doesn\'t match current password.');

        $this->validate($request, [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'old_password' => 'required_with:new_password,new_password_confirmation|min:6|old_password:'.Auth::user()->password,
            'new_password' => 'required_with:old_password,new_password_confirmation|confirmed|min:6|different:old_password',
            'new_password_confirmation' => 'required_with:old_password,new_password|min:6',
        ]);

        

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!empty($request->input('old_password'))) {
            $user->password = bcrypt($request->input('new_password'));
        }      

        $user->save();

        flash()->success('Profile telah diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('profile.show');
    }
}
