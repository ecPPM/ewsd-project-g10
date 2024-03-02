<?php

namespace App\Livewire\Pages\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TutorsDetailsPage extends Component
{
    use WithPagination;

    public $tutorId;

    public function mount($tutorId)
    {
        $this->tutorId = $tutorId;
    }

    public function render()
    {
        $tutor = User::where('id', $this->tutorId)->first();
        $tutor->studentCount = $tutor->activeStudents()->count();
        $assignedStudents = $tutor->activeStudents()->paginate(10);
        return view('livewire.pages.admin.tutors-details-page', [
            'tutor' => $tutor,
            'assignedStudents' => $assignedStudents,
        ]);
    }
}
