<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class StudentDetailsPage extends Component
{

    public $studentId;

    public function mount($studentId)
    {
        $this->studentId = $studentId;
    }


    public function render()
    {
        $student = User::where('id', $this->studentId)->first();
        return view('livewire.student-details-page', ['student' => $student]);
    }
}
