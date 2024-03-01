<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function students()
    {
        return view("students");
    }

    public function studentDetails(string $studentId)
    {
        return view("students-details", ['studentId' => $studentId]);
    }
}
