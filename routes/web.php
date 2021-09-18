<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('web');

Route::prefix('admin')->group(function() {
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard')->middleware('auth:admin');
}) ;



Route::prefix('superAdmin')->group(function() {
    Route::get('/login','Auth\superAdminLoginController@showLoginForm')->name('superAdmin.login');
    Route::post('/login', 'Auth\superAdminLoginController@login')->name('superAdmin.login.submit');
    Route::get('logout/', 'Auth\superAdminLoginController@logout')->name('superAdmin.logout');
    Route::get('/', 'superAdminController@index')->name('superAdmin.dashboard')->middleware('auth:superAdmin');
}) ;