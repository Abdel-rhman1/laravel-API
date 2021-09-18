<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Response;
use JWTFactory;
use JWTAuth;
class RegisterController extends Controller
{
    public function register(Request $res){
        $valid = Validator::make($res->all() , [
            'name'=>'required|max:25',
            'email'=>'required|max:25|email|unique:users',
            'password'=>'required|max:50',
        ],
        [
            'name.required'=>'Your Name Is Required',
            'name.max'=>'Your Name is Very Long',
            'email.required'=>'Youy Mail Is required',
            'email.max'=>'Your Mail Is Very Long',
            'email.unique'=>'Your email Is registered Before iN our System',
            'email.email'=>'Your Mail Is Invalid',
            'password.required'=>'Your Paassword Is Required',
            'password.max'=>'Your Password iS very Long',
        ]);

        if($valid->fails()) return response()->json($valid->errors());
        User::create([
            'name'=>$res->name,
            'email'=>$res->email,
            'password'=>$res->password,
        ]);

        $user = User::first();
        $token = JWTAuth::fromUser($user);
        return Response::json(compact('token'));
    }
}