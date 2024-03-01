<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TutorsController extends Controller
{
    public function tutors()
    {
        return view("tutors");
    }

    public function tutorDetails(string $tutorId)
    {
        return view("tutors-details", ['tutorId' => $tutorId]);
    }
}
