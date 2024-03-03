<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\AssignTutorMail;

class MailController extends Controller
{
    public function sendTutorAssignMails($tutor, $student)
    {
        $tutorMailSubject = "New Student Assigned";
        $tutorMailBody = "Dear $tutor->name,\n\nTutee $student->name has been assigned under your supervision.\n\nRegards,\nEtutoring System";

        $studentMailSubject = "New Tutor Assigned";
        $studentMailBody = "Dear $student->name,\n\nYou have been assigned to the tutor $tutor->name. Please contact your tutor for further instructions.\n\nRegards,\nEtutoring System";

        Mail::to($tutor->email)->send(new AssignTutorMail($tutorMailSubject, $tutorMailBody));
        Mail::to($student->email)->send(new AssignTutorMail($studentMailSubject, $studentMailBody));
    }
}
