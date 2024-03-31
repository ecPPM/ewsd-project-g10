<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;

class UserController extends Controller
{
    public function meetings()
    {
        PageView::logPageView(Auth::user()->id, '/meetings', Agent::browser());
        return view("pages.user.meetings");
    }

    public function blog()
    {
        PageView::logPageView(Auth::user()->id, '/blog', Agent::browser());
        return view("pages.user.blog");
    }
}
