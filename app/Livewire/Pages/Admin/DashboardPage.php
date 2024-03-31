<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Post;
use App\Models\StudentTutor;
use App\Models\User;
use Carbon\Carbon;
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

    public function getNumberOfMessages()
    {
        return Post::count();
    }

    public function getNumberOfStudentsWithoutTutor()
    {
        return StudentTutor::whereNull('tutor_id')->count();
    }

    public function getPageViewsData()
    {
        $pageViewsData = DB::table('page_views')
            ->select('page_url', DB::raw('count(*) as views'))
            ->groupBy('page_url')
            ->orderByDesc('views')
            ->get();

        return $pageViewsData;
    }

    public function getInactiveStudents($inactiveDays)
    {
        $inactiveDate = Carbon::now()->subDays($inactiveDays);

        $inactiveStudents = User::where('role_id', '=', 3) // Assuming student role_id is 1
            ->whereNotExists(function ($query) use ($inactiveDate) {
                $query->select(DB::raw(1))
                    ->from('interaction_logs')
                    ->whereColumn('interaction_logs.student_id', 'users.id')
                    ->where('interaction_logs.created_at', '>=', $inactiveDate);
            })
            ->get();

        return $inactiveStudents;
    }

    public function render()
    {
        $students = User::where('role_id', 3)->paginate(6);
        $inactiveStudentCount = count($this->getInactiveStudents($this->inactiveDays));

        return view('livewire.pages.admin.dashboard-page', [
            'students' => $students,
            'numberOfMessages' => $this->getNumberOfMessages(),
            'studentsWithoutTutor' => $this->getNumberOfStudentsWithoutTutor(),
            'inactiveStudentCount' => $inactiveStudentCount,
            'pageViewsData' => $this->getPageViewsData()
        ]);
    }
}
