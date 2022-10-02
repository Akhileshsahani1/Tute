<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Illuminate\Http\Response;
use JWTAuth;

class ApiController extends Controller
{
     public function Login(Request $request)
     {
        $email = $request->email;
        $user = User::where('email',$email)->first();
        if($user)
        {
            $password = Hash::check($request->password,$user->password);
            // dd($request->password,$Admin->password);
            if($password)
            {
                $token = JWTAuth::fromUser($user);
        
                return ['status'=>'ok','message'=>'User Login successfully','token'=>$token];
            }else{
                return ['status'=>false,'type'=>400,'message'=>' email or password does not exists,Register first'];
            }
         
        }

    }

    public function register(Request $request) {
        // dd("here");
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => Hash::make($request->password)]
                ));
        return response()->json([
            'message' => 'Admin successfully registered',
            'user' => $user
        ], 201);
        
    }
   
  
}
