<?php

namespace App\Livewire\Pages\Tutor;

use App\Models\Meeting;
use App\Models\MeetingNote;
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
    public $title;

    #[Rule('required')]
    public $time;

    public $location;
    public $platform;
    public $invitationLink;

    public $studentResponse;

    public $description;
    public $notes = [];

    public $editingNote;
    // -----------------------
    // Create
    public $modalOpen = false;

    // -----------------------
    // Edit
    public $editingMeetingId;

    public $modalEditPendingOpen = false;
    public $modalEditFinshedOpen = false;

    //public $editingMeeting;

    // -------------------- Model functions ----------------------
    public function createNewMeeting()
    {
        Meeting::create([
            'student_id' => $this->selectedStudentId,
            'tutor_id' => Auth::user()->id,
            'title' => $this->title,
            'mode' => $this->selectedMode,
            'time' => $this->time,
            'location' => $this->location,
            'platform' => $this->platform,
            'invitation_link' => $this->invitationLink,
            'description' => $this->description,
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
                'title' => $this->title,
                'mode' => $this->selectedMode,
                'time' => $this->time,
                'location' => $this->location,
                'platform' => $this->platform,
                'invitation_link' => $this->invitationLink,
                'description' => $this->description,
            ]);
            // success message
        }

        $this->clearAll();
    }

    public function deleteMeeting($id)
    {
        $meeting = Meeting::find($id);

        if ($meeting) {
            $meeting->delete();
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
        $this->reset(['selectedStudentId', 'selectedMode', 'title', 'time', 'location', 'platform', 'invitationLink', 'description', 'notes', 'modalOpen']);
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

        $this->setMeetingDetails();
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
        $this->reset(['editingMeetingId', 'selectedStudentId', 'selectedMode', 'title', 'time', 'location', 'platform', 'invitationLink', 'description', 'notes', 'modalEditPendingOpen', 'modalEditFinshedOpen']);
    }

    public function setMeetingDetails()
    {
        if ($this->editingMeetingId !== 0) {
            $editingMeeting = Meeting::find($this->editingMeetingId);

            $this->selectedStudentId = $editingMeeting->student->id;
            $this->time = $editingMeeting->time;
            $this->title = $editingMeeting->title;
            $this->selectedMode = $editingMeeting->mode;
            $this->location = $editingMeeting->location;
            $this->platform = $editingMeeting->platform;
            $this->invitationLink = $editingMeeting->invitation_link;
            $this->studentResponse = $editingMeeting->student_response;
            $this->description = $editingMeeting->description;

            $this->notes = $editingMeeting->notes;
        }
    }
    // -----------   Add Note   ------------
    public function addNote()
    {
        MeetingNote::create([
            'meeting_id' => $this->editingMeetingId,
            'user_id' => Auth::user()->id,
            'content' => $this->editingNote,
        ]);
        // success message
        $this->setMeetingDetails();
        $this->clearNote();
    }

    public function clearNote()
    {
        $this->reset(['editingNote']);
    }

    // ------------------------------------
    public function render()
    {
        return view('livewire.pages.tutor.tutor-meetings-page', [
            'pendingMeetings' => Auth::user()->pendingMeetings,
            'finishedMeetings' => Auth::user()->finishedMeetings,
            'activeStudents' => Auth::user()->activeStudents,
        ]);
    }
}
