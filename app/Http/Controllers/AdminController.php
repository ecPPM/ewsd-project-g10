<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;

class AdminController extends Controller
{
    public function students()
    {
        PageView::logPageView(Auth::user()->id, '/students', Agent::browser());
        return view("pages.admin.students");
    }

    public function studentDetails(string $studentId)
    {
        PageView::logPageView(Auth::user()->id, '/students/id', Agent::browser());
        return view("pages.admin.students-details", ['studentId' => $studentId]);
    }

    public function tutors()
    {
        PageView::logPageView(Auth::user()->id, '/tutors', Agent::browser());
        return view("pages.admin.tutors");
    }

    public function tutorDetails(string $tutorId)
    {
        PageView::logPageView(Auth::user()->id, '/tutors/id', Agent::browser());
        return view("pages.admin.tutors-details", ['tutorId' => $tutorId]);
    }

    public function reports()
    {
        return view("pages.admin.reports");
    }
}
