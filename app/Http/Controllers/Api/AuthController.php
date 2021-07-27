<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'

        ]);
        $credentials=request(['email','password']);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message'=>'Invalid Email or Password'

            ],401);    }
            $user=$request->user();
            $token=$user->createToken("Access Token");
            $user->access_token=$token->accessToken;
            return response()->json([
                'user'=>$user,


            ],200);
    }
    public function signUp(Request $request){
        
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',//unique in users table
            'password'=>'required|string|confirmed'//this will require password_confirmed fild along with all fields

        ]);
        $user=new User([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)

        ]);
        $user->save();
        return response()->json([
            'message'=>'User registered successfully'
        ],201);

    }

    public function logOut(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message'=>'user logged out successfully'

        ]);

    }
    public function getdata(){
        return 'getdata requested';
    }
}
