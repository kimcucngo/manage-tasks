<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
// Show a profile for given user

     public function profile ()
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);
        return view('user.userprofile',compact('userData'));
    }
     public function editProfile ()
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);
        return view('user.editprofile',compact('userData'));
    }
     public function postEditProfile(ProfileUpdateRequest $request)
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);
        $validated = $request->validated();
    
        $userData->name=$request->name;
        $userData->email=$request->email;
        $userData->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'Success'
        );

        return redirect()->route('user.profile')->with($notification);
    }
    public function editPass()
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);
        return view('user.editpass',compact('userData'));
    } 
    public function postPass(PasswordRequest $request)
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);
        $validated = $request->validated();

        if(Hash::check($request->oldpassword,$userData->password)){
            $userData->password = bcrypt($request->newpassword);
            $userData->save();
            return view('user.userprofile', compact('userData'));
        }
        else{
            return back()->with("error", "Old Password Doesn't match!");
        }
    }
    public function logoutPage(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return view('auth.login');
    } 
}