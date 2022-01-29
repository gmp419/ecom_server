<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function profile()
    {
        $data = User::find(1);
        return view('backend.admin.profile', compact('data'));
    }

    public function edit_profile(Request $request){
        $user = User::find(1);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->file('profile_photo_path')){
            $image = $request->file('profile_photo_path');
            @unlink(public_path('upload/adminImages/'.$user->profile_photo_path));
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload/adminImages'), $imageName);
            $user->profile_photo_path = $imageName;
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');

    }
}
