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

    public $days = 7;

    public function handleRowClick($userId)
    {
        return redirect()->to('/students/' . $userId);
    }

    public function getNumberOfMessages($days)
    {
        return Post::where('created_at', '>=', now()->subDays($days))->count();
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

        return collect($pageViewsData)->map(function ($item) {
            switch ($item->page_url) {
                case '/dashboard':
                    $item->page_url = 'Dashboard';
                    break;
                case '/students':
                    $item->page_url = 'Students List';
                    break;
                case '/tutors':
                    $item->page_url = 'Tutors List';
                    break;
                case '/students/id':
                    $item->page_url = 'Student Details';
                    break;
                case '/tutors/id':
                    $item->page_url = 'Tutor Details';
                    break;
                case '/meetings':
                    $item->page_url = 'Scheduling';
                    break;
                case '/blog':
                    $item->page_url = 'Chats';
                    break;
            }
            if ($item->page_url == '/dashboard')
                $item->page_url = 'Dashboard';
            return $item;
        });
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
        })->get();
        return $inactiveStudents;
    }

    public function render()
    {
        $students = User::where('role_id', 3)->paginate(10);
        $inactiveStudentCount = count($this->getInactiveStudents($this->days));

        function findMax($pageViewsData): int
        {
            $maxPageViews = $pageViewsData->max('views');
            $maxValue = 100;
            while ($maxValue < $maxPageViews) {
                $maxValue += 100;
            }
            return $maxValue;
        }

//        $maxPageViews = DB::table('page_views')->max('views');

        return view('livewire.pages.admin.dashboard-page', [
            'students' => $students,
            'numberOfMessages' => $this->getNumberOfMessages($this->days),
            'studentsWithoutTutor' => $this->getNumberOfStudentsWithoutTutor(),
            'inactiveStudentCount' => $inactiveStudentCount,
            'pageViewsData' => $this->getPageViewsData(),
            'maxPageViews' => findMax($this->getPageViewsData())
        ]);
    }
}
