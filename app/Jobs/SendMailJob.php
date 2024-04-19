<?php

namespace App\Jobs;

use App\Mail\AssignStudentMail;
use App\Mail\AssignTutorMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $student;
    protected $tutor;

    public function __construct($tutor, $student)
    {
        $this->student = $student;
        $this->tutor = $tutor;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tutorMailSubject = "New Student Assigned";
        $studentMailSubject = "New Tutor Assigned";

        $namesForMailBody = ["student" => $this->student->name, "tutor" => $this->tutor->name];

        Mail::to($this->student->email)->send(new AssignTutorMail($studentMailSubject, $namesForMailBody));
        Mail::to($this->tutor->email)->send(new AssignStudentMail($tutorMailSubject, $namesForMailBody));
    }

    public function delay()
    {
        return now()->addSeconds(10); // Wait 2 seconds before processing the job
    }
}
