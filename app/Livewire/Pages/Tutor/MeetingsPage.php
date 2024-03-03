<?php

namespace App\Livewire\Pages\Tutor;

use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class MeetingsPage extends Component
{
    // Form components
    #[Rule('required')]
    public $selectedStudentId = "default";

    #[Rule('required')]
    public $selectedMode = "default";

    #[Rule('required')]
    public $time;

    public $location;
    public $platform;
    public $invitationLink;

    public $notes;
    // -----------------------
    public $modalOpen = false;

    public function createNewMeeting()
    {
        Meeting::create([
            'student_id' => $this->selectedStudentId,
            'tutor_id' => Auth::user()->id,
            'mode' => $this->selectedMode,
            'time' => $this->time,
            'location' => $this->location,
            'platform' => $this->platform,
            'invitation_link' => $this->invitationLink,
            'notes' => $this->notes,
        ]);

        $this->clear();
    }

    public function toggleModal()
    {
        $this->modalOpen = !$this->modalOpen;
    }

    public function clear()
    {
        $this->reset(['selectedStudentId', 'selectedMode', 'time', 'location', 'platform', 'invitationLink', 'notes']);
    }

    public function render()
    {
        return view('livewire.pages.tutor.meetings-page', [
            'pendingMeetings' => Auth::user()->pendingMeetings,
            'finishedMeetings' => Auth::user()->finishedMeetings,
            'activeStudents' => Auth::user()->activeStudents,
        ]);
    }
}
