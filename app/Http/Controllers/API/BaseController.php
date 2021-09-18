<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
class BaseController extends Controller
{
    public function sendSuccess($results , $message){
        $response = [
            'status'=>true,
            'data'=>$results,
            'message'=>$message,
        ];
        return response()->json($response , 200); 
    }
    public function sendErrors($error , $message = [] , $code=404){
        $error = [
            'status'=>false,
            'error'=>$error,
        ];
        if(!empty($message)){
            $error ['data'] = $message;
        }
        return response()->json($error , $code);
    }
}
