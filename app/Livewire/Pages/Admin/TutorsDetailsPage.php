<?php

namespace App\Livewire\Pages\Admin;

use App\Models\File;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TutorsDetailsPage extends Component
{
    use WithPagination;

    public $inactiveDays = 7;
    public $tutorId;

    public function mount($tutorId)
    {
        $this->tutorId = $tutorId;
    }

    public function getData()
    {
        $messages = Post::where(function ($query) {
                $query->where('sender_id', $this->tutorId)
                    ->orWhere('receiver_id', $this->tutorId);
            });

        $messageIds = $messages->pluck('id')->toArray();

        $numberOfFiles = File::whereIn('fileable_id', $messageIds)
            ->where('fileable_type', 'post')
            ->count();

        return [
            "messages" => $messages->count(),
            "files" => $numberOfFiles
        ];
    }

    public function getInactiveStudents($inactiveDays)
    {
        $inactiveDate = Carbon::now()->subDays($inactiveDays);

        $inactiveStudents = User::where('id', $this->tutorId)->first()->activeStudents()
            ->whereNotExists(function ($query) use ($inactiveDate) {
                $query->select(DB::raw(1))
                    ->from('interaction_logs')
                    ->whereColumn('interaction_logs.student_id', 'users.id')
                    ->where('interaction_logs.created_at', '>=', $inactiveDate);
            })->get();

        return $inactiveStudents;
    }

    function getDistinctStudentIdsFromInteractionLogsTable()
    {
        return DB::table('interaction_logs')
            ->distinct()
            ->pluck('student_id')
            ->toArray();
    }

    public function render()
    {
        $tutor = User::where('id', $this->tutorId)->first();
        $tutor->studentCount = $tutor->activeStudents()->count();
        $assignedStudents = $tutor->activeStudents()->orderBy('last_logged_in', 'desc')->paginate(10);

        // $studentIdsOfThisTutor = $tutor->activeStudentIds();
        // $activeStudentIds = $this->getDistinctStudentIdsFromInteractionLogsTable();

        // $zeroActivityStudents = count(array_diff($studentIdsOfThisTutor, $activeStudentIds));

        // $inactiveStudentCount = count($this->getInactiveStudents($this->inactiveDays)) + $zeroActivityStudents;
        $inactiveStudentCount = count($this->getInactiveStudents($this->inactiveDays));

        $data = $this->getData();

        return view('livewire.pages.admin.tutors-details-page', [
            'tutor' => $tutor,
            'assignedStudents' => $assignedStudents,
            'numberOfMessages' => $data['messages'],
            'numberOfFiles' => $data['files'],
            'inactiveStudentCount' => $inactiveStudentCount,
        ]);
    }
}
