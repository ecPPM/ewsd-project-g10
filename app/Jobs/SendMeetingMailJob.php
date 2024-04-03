<?php

namespace App\Jobs;

use App\Mail\NewMeetingMail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMeetingMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $student;
    protected $meeting;

    /**
     * Create a new job instance.
     */
    public function __construct($meeting, $student)
    {
        $this->student = $student;
        $this->meeting = $meeting;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mailSubject = "New Meeting Alert";

        $dataForMailBody = $this->meeting;
        $dataForMailBody->formattedTime = Carbon::parse($dataForMailBody->time)->format('h:i A / M d, Y');

        Mail::to($this->student->email)->send(new NewMeetingMail($mailSubject, $dataForMailBody));
    }

    public function delay()
    {
        return now()->addSeconds(10);
    }
}
