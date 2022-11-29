<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    //
    public function Logout(){
        Auth::logout();
        return redirect('/login');
    }
}
