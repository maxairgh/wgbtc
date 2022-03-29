<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //dashboard 
    public function dashboard(){
        if (strcmp(Auth::user()->type,'admin') == 0){
            return view('admin.dashboard');
        }
    
        if (strcmp(Auth::user()->type,'learner') == 0){
            return view('learners.dashboard');
        }
    
        if (strcmp(Auth::user()->type,'facilitator') == 0){
            return view('facilitators.dashboard');
        }

    }

    //login 
    public function logIn(){
        return view('auth.login');
    }

}
