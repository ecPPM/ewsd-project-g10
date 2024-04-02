<?php

namespace App\Livewire\Pages\Tutor;

use App\Models\File;
use App\Models\Post;
use App\Models\StudentTutor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardPage extends Component
{
    use WithPagination;

    public $inactiveDays = 7;

    public function handleRowClick($userId)
    {
        return redirect()->to('/students/' . $userId);
    }

    public function getData()
    {
        $messages = Post::where(function ($query) {
                $query->where('sender_id', Auth::user()->id)
                    ->orWhere('receiver_id', Auth::user()->id);
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

        $inactiveStudents = Auth::user()->activeStudents()
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
        $students = Auth::user()->activeStudents()
            ->orderBy('last_logged_in', 'desc')
            ->paginate(10);

        $studentIdsOfThisTutor = Auth::user()->activeStudentIds();
        $activeStudentIds = $this->getDistinctStudentIdsFromInteractionLogsTable();

        $zeroActivityStudents = count(array_diff($studentIdsOfThisTutor, $activeStudentIds));

        $inactiveStudentCount = count($this->getInactiveStudents($this->inactiveDays)) + $zeroActivityStudents;

        return view('livewire.pages.tutor.dashboard-page', [
            'students' => $students,
            'numberOfMessages' => $this->getData()['messages'],
            'numberOfFiles' => $this->getData()['files'],
            'inactiveStudentCount' => $inactiveStudentCount,
        ]);
    }
}
