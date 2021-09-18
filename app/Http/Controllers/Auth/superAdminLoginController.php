<?php

namespace App\Http\Controllers\Auth;
use App\Models\superAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
class superAdminLoginController extends Controller
{ public function __construct()
    {
      $this->middleware('guest:superAdmin', ['except' => ['logout']]);
    }
    public function showLoginForm(){
        return view('auth.superAdmin');
    }
    public function login(Request $res){
        $valid = Validator::make($res->all(),[
            'email'=>'required|email',
            'password'=>'min:6|max:12|required',
        ],[
            'email.required'=>'Mail Is required',
            'email.email'=>'this is Invalid mail',

            'password.min'=>'this pass is very short',
            'password.max'=>'this pass is very lang',
        ]
        );

        if(Auth::guard('superAdmin')->attempt(['email'=>$res->email , 'password'=>$res->password],$res->remember)){
            return redirect()->intended(route('superAdmin.dashboard'));
        }
        
        return redirect()->back()->withInput($res->only('email', 'remember'));
        
    }
    public function logout()
    {
        Auth::guard('superAdmin')->logout();
        return redirect('/superAdmin');
    }
}
