<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;

class CommonController extends Controller
{
    public function dashboard()
    {
        PageView::logPageView(Auth::user()->id, '/dashboard', Agent::browser());
        if(Auth::user()->role_id == 1) {
            return view("pages.admin.dashboard");
        } elseif (Auth::user()->role_id == 2) {
            return view("pages.tutor.dashboard");
        } else {
            return view("pages.student.dashboard");
        }
    }
}
