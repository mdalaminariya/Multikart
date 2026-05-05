<?php

namespace App\Http\Controllers\Backend\HomeController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index(){
        return view('backend.home.home');
    }
}
