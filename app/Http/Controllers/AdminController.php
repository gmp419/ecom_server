<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function change_password(){
        return view('backend.admin.password');
    }

    public function update_password(Request $request){

        $validate = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        // $hashedPassword = User::find(1)->password;
        // if (Hash::check($request->current_password,$hashedPassword)) {
        //     $user = User::find(1);
        //     $user->password = Hash::make($request->password);
        //     $user->save();
        //     Auth::logout();
        //     return redirect()->back();
        // }
        // else{
        //     return redirect()->back()->with('error','Something went wrong');
        // }

        $user = User::find(1);
        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/login')->with('success', 'Password changed successfully');
        }
        else{
            return redirect('/dashboard');
        }

    }
}
