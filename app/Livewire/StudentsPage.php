<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class StudentsPage extends Component
{
    use WithPagination;

    public $studentIds = [];

    public $assignedTutorId = "default";

    public $modalOpen = false;

    public $search = "";

    public function handleRowClick($userId)
    {
        return redirect()->to('/students/' . $userId);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleModal()
    {
        $this->modalOpen = !$this->modalOpen;
    }

    public function clearSelection()
    {
        $this->reset('studentIds');
    }

    public function toggleSelect($userId): void
    {
        if (in_array($userId, $this->studentIds)) {
            $this->studentIds = array_diff($this->studentIds, [$userId]);
        } else {
            $this->studentIds[] = $userId;
        }
    }

    public function bulkAllocate(): void
    {
        if ($this->assignedTutorId === "") return;

        foreach ($this->studentIds as $studentId) {
            $user = User::where('id', $studentId)->first();
            $user->assignOrChangeTutor($this->assignedTutorId);
        }
        $this->reset('studentIds', 'assignedTutorId', 'search', 'modalOpen');
    }

    public function toggleSelectAll()
    {
        if (count($this->studentIds) === count(User::where('role_id', 3)->get())) {
            $this->studentIds = [];
        } else {
            $this->studentIds = User::where('role_id', 3)->pluck('id')->toArray();
        }
    }


    public function render()
    {
        $students = User::where('role_id', 3)->where('name', 'like', "%{$this->search}%")->paginate(10);
        $tutors = User::where('role_id', 2)->get();

        return view('livewire.students-page', [
            'students' => $students,
            'tutors' => $tutors,
            'selectedIds' => $this->studentIds,
            'showModal' => $this->modalOpen
        ]);
    }
}
