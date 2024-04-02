<?php

namespace App\Jobs;

use App\Mail\InactivityWarningMail;
use App\Mail\StudentWarningMail;
use App\Mail\TutorWarningMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWarningMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $student;
    protected $tutor;

    /**
     * Create a new job instance.
     */
    public function __construct($student, $tutor)
    {
        $this->student = $student;
        $this->tutor = $tutor;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mailSubject = "Important: Lack of Interaction Warning - Action Required";

        $namesForMailBody = ["student" => $this->student->name, "tutor" => $this->tutor->name];

        Mail::to($this->student->email)->send(new StudentWarningMail($mailSubject, $namesForMailBody));
        Mail::to($this->tutor->email)->send(new TutorWarningMail($mailSubject, $namesForMailBody));
    }

    public function delay()
    {
        return now()->addSeconds(10); // Wait 2 seconds before processing the job
    }
}
