<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\Models\superAdmin;
class superAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superAdmin');
    }
    public function index(){
        return view('superAdmin');
    }
}
