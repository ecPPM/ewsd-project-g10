<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function students()
    {
        return view("pages.admin.students");
    }

    public function studentDetails(string $studentId)
    {
        return view("pages.admin.students-details", ['studentId' => $studentId]);
    }

    public function tutors()
    {
        return view("pages.admin.tutors");
    }

    public function tutorDetails(string $tutorId)
    {
        return view("pages.admin.tutors-details", ['tutorId' => $tutorId]);
    }

    public function reports()
    {
        return view("pages.admin.reports");
    }
}
