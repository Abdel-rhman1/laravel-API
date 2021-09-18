<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login' , "LoginController@login");
Route::post('/register' , "RegisterController@register");


Route::group(['middleware'=>'jwt.auth'] , function (){
    Route::get('/users' , function(Request $resquest){
        return auth()->user();
    });
    Route::get("/products" , "API\ProductController@index");
    Route::post("/create" , "API\ProductController@create");
    Route::post("/edit/{id}" , "API\ProductController@edit");
    Route::post("/delete/{id}" , "API\ProductController@delete");
    
});

