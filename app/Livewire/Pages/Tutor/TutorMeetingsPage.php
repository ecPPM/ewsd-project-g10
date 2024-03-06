<?php

namespace App\Livewire\Pages\Tutor;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TutorMeetingsPage extends Component
{
    // Form components for create
    #[Rule('required')]
    public $selectedStudentId = 'default';

    #[Rule('required')]
    public $selectedMode = 'Online';

    #[Rule('required')]
    public $time;

    public $location;
    public $platform;
    public $invitationLink;

    public $notes;
    // -----------------------
    // Create
    public $modalOpen = false;

    // -----------------------
    // Edit
    public $editingMeetingId;

    public $modalEditPendingOpen = false;
    public $modalEditFinshedOpen = false;

    public $editingMeeting;

    // -------------------- Model functions ----------------------
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
            'is_cancelled' => false
        ]);
        // success message

        $this->clear();
    }

    public function editMeeting()
    {
        $meeting = Meeting::find($this->editingMeetingId);

        if ($meeting) {
            $meeting->update([
                'student_id' => $this->selectedStudentId,
                'tutor_id' => Auth::user()->id,
                'mode' => $this->selectedMode,
                'time' => $this->time,
                'location' => $this->location,
                'platform' => $this->platform,
                'invitation_link' => $this->invitationLink,
                'notes' => $this->notes,
                'is_cancelled' => false
            ]);
            // success message
        }

        $this->clearAll();
    }

    public function cancelMeeting($id)
    {
        $meeting = Meeting::find($id);

        if ($meeting) {
            $meeting->update([
                'is_cancelled' => true
            ]);
            // success message
        }
    }

    // --------------- CREATE MEETING -----------------

    public function toggleModal()
    {
        $this->modalOpen = !$this->modalOpen;
    }

    public function clear()
    {
        $this->reset(['selectedStudentId', 'selectedMode', 'time', 'location', 'platform', 'invitationLink', 'notes', 'modalOpen']);
    }

    // ----------------- EDIT MEETING -------------------

    public function handleEditClick($meetingType, $meetingId)
    {
        $this->editingMeetingId = $meetingId;

        if ($meetingType === 'pending') {
            $this->toggleEditPendingModal();
        } else {
            $this->toggleEditFinishedModal();
        }

        $this->editingMeeting = $this->setMeetingDetails();
    }

    public function toggleEditPendingModal()
    {
        $this->modalEditPendingOpen = !$this->modalEditPendingOpen;
    }

    public function toggleEditFinishedModal()
    {
        $this->modalEditFinshedOpen = !$this->modalEditFinshedOpen;
    }

    public function clearAll()
    {
        $this->reset(['editingMeetingId', 'selectedStudentId', 'selectedMode', 'time', 'location', 'platform', 'invitationLink', 'notes', 'modalEditPendingOpen', 'modalEditFinshedOpen']);
    }

    public function setMeetingDetails()
    {
        $editingMeeting = null;
        if ($this->editingMeetingId !== 0) {
            $editingMeeting = Meeting::find($this->editingMeetingId);

            $this->selectedStudentId = $editingMeeting->student->id;
            $this->time = $editingMeeting->time;
            $this->selectedMode = $editingMeeting->mode;
            $this->location = $editingMeeting->location;
            $this->platform = $editingMeeting->platform;
            $this->invitationLink = $editingMeeting->invitation_link;
            $this->notes = $editingMeeting->notes;
        }

        return $editingMeeting;
    }

    public function render()
    {
        return view('livewire.pages.tutor.tutor-meetings-page', [
            'pendingMeetings' => Auth::user()->pendingMeetings,
            'finishedMeetings' => Auth::user()->finishedMeetings,
            'activeStudents' => Auth::user()->activeStudents,
        ]);
    }
}
