<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\ForgetMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];

        return response($res, Response::HTTP_CREATED);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];

        return response($res, Response::HTTP_CREATED);
    }

    public function forgetPassword(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        // $res = [
        //     'user' => $user,
        //     'token' => $token
        // ];

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token
        ]);

        // Mail Send to User 
        Mail::to($user)->send(new ForgetMail($token));

        return response([
            'message' => 'Reset password mail send on your email'
        ], 200);
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // $updatePassword = DB::table('password_resets')
        //     ->where(['email' => $request->email])
        //     ->first();

        // if ($updatePassword->token != $request->token) {
        //     return response()->json(['message' => 'Invalid token']);
        // }

        // $user = User::where('email', $request->email)->first();

        // $user->password = Hash::make($request->password);
        // $user->save();



        // return response([
        //     'message' => 'Password reset successfully'
        // ], 200);
        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $emailcheck = DB::table('password_resets')->where('email', $email)->first();
        $pincheck = DB::table('password_resets')->where('token', $token)->first();

        if (!$emailcheck) {
            return response([
                'message' => "Email Not Found"
            ], 401);
        }
        if (!$pincheck) {
            return response([
                'message' => "Pin Code Invalid"
            ], 401);
        }

        DB::table('users')->where('email', $email)->update(['password' => $password]);
        DB::table('password_resets')->where('email', $email)->delete();

        $user = User::where('email', $request['email'])->first();

        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response($res, Response::HTTP_CREATED);
    }

    public function getUser(Request $request)
    {
        $user = auth('sanctum')->user();
        return response($user);
    }
}
