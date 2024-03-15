<?php

namespace App\Livewire\Pages\Student;

use App\Models\InteractionLog;
use App\Models\Meeting;
use App\Models\MeetingNote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentMeetingsPage extends Component
{
    public $editingMeetingId;

    public $notes = [];
    public $editingNote;

    public $modalAddNoteOpen = false;

    public function handleRespondMeeting($meetingId, $response)
    {
        $meeting = Meeting::find($meetingId);

        $meeting->update([
            'student_response' => $response
        ]);

        InteractionLog::addInteractionLogEntry($meeting->student_id, null, 5, $meeting->id);
    }

    public function handleEditClick($meetingType, $meetingId)
    {
        $this->editingMeetingId = $meetingId;

        $this->updateNotes();

        $this->toggleAddNoteModal();
    }

    public function toggleAddNoteModal()
    {
        $this->modalAddNoteOpen = !$this->modalAddNoteOpen;
    }

    public function addNote()
    {
        $note = MeetingNote::create([
            'meeting_id' => $this->editingMeetingId,
            'user_id' => Auth::user()->id,
            'content' => $this->editingNote,
        ]);

        $this->updateNotes();

        InteractionLog::addInteractionLogEntry(Auth::user()->id, null, 6, $note->meeting->id);

        $this->clearNote();
    }

    public function updateNotes()
    {
        $this->notes = Meeting::find($this->editingMeetingId)->notes;
    }

    public function clearNote()
    {
        $this->reset(['editingNote']);
    }

    public function clearAll()
    {
        $this->reset(['editingNote','modalAddNoteOpen','editingMeetingId']);
    }

    public function render()
    {
        return view('livewire.pages.student.student-meetings-page', [
            'pendingMeetings' => Auth::user()->pendingMeetings,
            'finishedMeetings' => Auth::user()->finishedMeetings,
        ]);
    }
}
