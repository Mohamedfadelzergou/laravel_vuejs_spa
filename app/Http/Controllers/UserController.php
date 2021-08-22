<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json(['status'=>'success','errors'=>$user->errors()]);
    }
    public function login()
    {
        $credentials = request(['name', 'password']);

        if ( $token = auth()->attempt($credentials)) {
            return response()->json(['status' => 'success','token' => $token]);
        }
        
        return response()->json(['status' => 'error']);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
