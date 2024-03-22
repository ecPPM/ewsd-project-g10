<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function meetings()
    {
        return view("pages.user.meetings");
    }

    public function blog()
    {
        return view("pages.user.blog");
    }
}
