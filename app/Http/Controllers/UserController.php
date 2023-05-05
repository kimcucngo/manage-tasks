<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     public function postEditProfile(Request $request)
    {
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);
        $userData->name=$request->name;
        $userData->email=$request->email;
        return view('user.userprofile',compact('userData'));
    }

}
