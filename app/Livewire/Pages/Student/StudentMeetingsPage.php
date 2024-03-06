<?php

namespace App\Livewire\Pages\Student;

use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentMeetingsPage extends Component
{
    public function render()
    {
        return view('livewire.pages.student.student-meetings-page', [
            'pendingMeetings' => Auth::user()->pendingMeetings,
            'finishedMeetings' => Auth::user()->finishedMeetings,
        ]);
    }
}
