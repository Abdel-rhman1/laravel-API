<?php

namespace App\Http\Controllers;

use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $res){
        $valid = Validator::make($res->all() , [
            'email'=>'required|email',
            'password'=>'required|min:6|max:12',
        ],[ 
            'email.required'=>  "Mail Is Required",
            'email.email'=>'INvalid Mail',
            'password.required'=>'Password Is Required',
            'password.min'=>'passord Is very small',
            'password.max'=>'password Is very Long',
        ]);

        if($valid->fails()) return response()->json($valid->errors());
        $credentials = $res->only('email','password');
         try{
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json( ['error'=> 'invalid username and password'],401);
            }
        }catch(JWTException $e){
          return response()->json( ['error'=> 'could not create token'],500);
        }
        return response()->json(compact('token'));
    }
}
