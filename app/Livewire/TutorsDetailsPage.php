<?php

namespace App\Livewire;

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
        $tutor->studentCount = $tutor->students->count();
        $assignedStudents = $tutor->students;
        return view('livewire.tutors-details-page', [
            'tutor' => $tutor,
            'assignedStudents' => $assignedStudents,
        ]);
    }
}
