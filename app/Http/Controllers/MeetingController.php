<?php

namespace App\Http\Controllers;

class MeetingController extends Controller
{
    public function meetings()
    {
        return view("pages.tutor.meetings");
    }
}
