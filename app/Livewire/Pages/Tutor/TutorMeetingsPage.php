<?php

namespace App\Livewire\Pages\Tutor;

use App\Http\Controllers\MailController;
use App\Models\InteractionLog;
use App\Models\Meeting;
use App\Models\MeetingNote;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class TutorMeetingsPage extends Component
{
    use LivewireAlert;
    use WithPagination;


    // Form components for create
    #[Validate('required', message: "The student name field is required.")]
    #[Validate('not_in:default', message: "The student name field is required.")]
    public $selectedStudentId = 'default';

    #[Validate('required', message: "The meeting platform field is required.")]
    public $selectedMode = 'Online';

    #[Validate('required')]
    public $title;

    public $time;

    #[Validate('required')]
    public $meetingDate;

    #[Validate('required')]
    public $meetingTime;

    #[Validate('required_if:selectedMode,==,In-Person', message: 'The location field is required.')]
    public $location;
    public $platform;

    #[Validate('required_if:selectedMode,==,Online', message: 'The meeting invitation link field is required.')]
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

    public $deletingMeetingId;

    public $modalDeleteOpen = false;


    //public $editingMeeting;

    // -------------------- Model functions ----------------------
    public function createNewMeeting()
    {
        $this->validate();

        $meeting = Meeting::create([
            'student_id' => $this->selectedStudentId,
            'tutor_id' => Auth::user()->id,
            'title' => $this->title,
            'mode' => $this->selectedMode,
            'time' => $this->getDateTime(),
            'location' => $this->location,
            'platform' => $this->platform,
            'invitation_link' => $this->invitationLink,
            'description' => $this->description,
        ]);
        // flash success message
        $this->alert('success', 'Successfully created.', [
            'customClass' => [
                'popup' => 'text-sm',
            ]
        ]);

        $mailController = new MailController();
        $mailController->sendMeetingMail($meeting, User::find($this->selectedStudentId));

        InteractionLog::addInteractionLogEntry(null, Auth::user()->id, 2, $meeting->id);
        $this->clear();
    }

    public function editMeeting()
    {
        $meeting = Meeting::find($this->editingMeetingId);

        $this->validate();


        if ($meeting) {
            $meeting->update([
                'student_id' => $this->selectedStudentId,
                'tutor_id' => Auth::user()->id,
                'title' => $this->title,
                'mode' => $this->selectedMode,
                'time' => $this->getDateTime(),
                'location' => $this->location,
                'platform' => $this->platform,
                'invitation_link' => $this->invitationLink,
                'description' => $this->description,
            ]);
            // flash success message
            $this->alert('success', 'Successfully updated.', [
                'customClass' => [
                    'popup' => 'text-sm',
                ]
            ]);

            InteractionLog::addInteractionLogEntry(null, Auth::user()->id, 3, $meeting->id);
        }

        $this->clearAll();
    }

    public function deleteMeeting()
    {
        if (!$this->deletingMeetingId) {
            return;
        }

        $meeting = Meeting::find($this->deletingMeetingId);

        if (!$meeting) {
            return;
        }

        if ($meeting) {
            InteractionLog::addInteractionLogEntry(null, Auth::user()->id, 4, $meeting->id);

            $meeting->delete();
            // flash success message
        }

        $this->clearAll();

        // flash success message
        $this->alert('success', 'Successfully deleted.', [
            'customClass' => [
                'popup' => 'text-sm',
            ]
        ]);
    }

    // --------------- CREATE MEETING -----------------

    public function toggleModal()
    {
        if (!$this->modalOpen) {
            $this->meetingDate = now()->format('Y-m-d');
            $this->meetingTime = now()->format('H:i');
        }
        $this->modalOpen = !$this->modalOpen;
    }

    public function clear()
    {
        $this->reset(['selectedStudentId', 'selectedMode', 'title', 'time', 'location', 'platform', 'invitationLink', 'description', 'notes', 'modalOpen', 'meetingDate', 'meetingTime']);
        $this->resetValidation();
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

    public function handleDeleteClick($meetingId)
    {
        $this->deletingMeetingId = $meetingId;
        $this->toggleDeleteModal();
    }

    public function toggleEditPendingModal()
    {
        $this->modalEditPendingOpen = !$this->modalEditPendingOpen;
    }

    public function toggleEditFinishedModal()
    {
        $this->modalEditFinshedOpen = !$this->modalEditFinshedOpen;
    }

    public function toggleDeleteModal()
    {
        $this->modalDeleteOpen = !$this->modalDeleteOpen;
    }

    public function clearAll()
    {
        $this->reset(['editingMeetingId', 'selectedStudentId', 'selectedMode', 'title', 'time', 'location', 'platform', 'invitationLink', 'description', 'notes', 'modalEditPendingOpen', 'modalEditFinshedOpen', 'modalDeleteOpen', 'deletingMeetingId']);
    }

    public function setMeetingDetails()
    {
        if ($this->editingMeetingId !== 0) {
            $editingMeeting = Meeting::find($this->editingMeetingId);

            $this->selectedStudentId = $editingMeeting->student->id;
            $this->time = $editingMeeting->time;
            $this->meetingDate = $editingMeeting->time->format('Y-m-d');
            $this->meetingTime = $editingMeeting->time->format('H:i');
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
        $note = MeetingNote::create([
            'meeting_id' => $this->editingMeetingId,
            'user_id' => Auth::user()->id,
            'content' => $this->editingNote,
        ]);

        InteractionLog::addInteractionLogEntry(null, Auth::user()->id, 6, $note->meeting->id);

        $this->setMeetingDetails();
        $this->clearNote();
    }

    public function clearNote()
    {
        $this->reset(['editingNote']);
    }

    public function getDateTime()
    {
        if (isset($this->meetingDate) && isset($this->meetingTime)) {
            $dateTime = new DateTime($this->meetingDate . ' ' . $this->meetingTime);
            return $dateTime->format('Y-m-d H:i');
        } else {
            return now();
        }
    }

    // ------------------------------------

    public function render()
    {
        return view('livewire.pages.tutor.tutor-meetings-page', [
            'pendingMeetings' => Auth::user()->pendingMeetings()->orderBy('time')->get(),
            'finishedMeetings' => Auth::user()->finishedMeetings()->orderBy('time', 'desc')->paginate(6),
            'activeStudents' => Auth::user()->activeStudents()->get(),
        ]);
    }
}
