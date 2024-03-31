<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function dashboard()
    {
        if(Auth::user()->role == 1) {
            return view("pages.admin.dashboard");
        } elseif (Auth::user()->role == 2) {
            return view("pages.tutor.dashboard");
        } else {
            return view("pages.student.dashboard");
        }
    }
}
