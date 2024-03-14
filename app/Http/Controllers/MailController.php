<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Jobs\SendMeetingMailJob;

class MailController extends Controller
{
    public function sendTutorAssignMails($tutor, $student)
    {
        dispatch(new SendMailJob($tutor, $student));
    }

    public function sendMeetingMail($meeting, $student)
    {
        dispatch(new SendMeetingMailJob($meeting, $student));
    }
}
