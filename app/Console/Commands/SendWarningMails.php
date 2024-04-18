<?php

namespace App\Console\Commands;

use App\Http\Controllers\MailController;
use App\Models\InteractionLog;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendWarningMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:warning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send warning notifications to students and tutors for no interaction over 28 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get student user IDs who have not had any interactions within the last 28 days
        $studentIds = DB::table('users')
            ->where('role_id', 3) // Assuming role_id 3 corresponds to students
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('interaction_logs')
                    ->whereRaw('interaction_logs.student_id = users.id')
                    ->where('created_at', '>', now()->subDays(28));
            })
            ->pluck('id');

        // Get students with no interactions over 28 days
        $students = User::whereIn('id', $studentIds)->get();
        //$counter = 0;

        foreach ($students as $student) {

            // Send notification email to students with tutor
            if ($student->activeTutor()){
                $mailController = new MailController();
                $mailController->sendWarningMail($student, $student->activeTutor());

                $tutor = $student->activeTutor();
                echo "\nMail sent to $student->name and $tutor->name";
                // $counter++;
                // if ($counter == 3) break;
            }
        }
    }
}
