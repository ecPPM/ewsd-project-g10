<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllocationController extends Controller
{
    public function dashboard()
    {
        return view("dashboard");
    }

    public function allocation()
    {
        return view("allocation");
    }
}
