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

    public function render()
    {
        $students = Auth::user()->activeStudents()
            ->orderBy('last_logged_in', 'desc')
            ->paginate(10);

        $inactiveStudentCount = count($this->getInactiveStudents($this->inactiveDays));

        $data = $this->getData();

        return view('livewire.pages.tutor.dashboard-page', [
            'students' => $students,
            'numberOfMessages' => $data['messages'],
            'numberOfFiles' => $data['files'],
            'inactiveStudentCount' => $inactiveStudentCount,
        ]);
    }
}
