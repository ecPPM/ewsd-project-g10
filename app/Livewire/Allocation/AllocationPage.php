<?php

namespace App\Livewire\Allocation;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllocationPage extends Component
{
    use WithPagination;

    public $search;

    public $editingStudentId;
    public $editingTutorName;

    public $isSelectingTutor;

    public $errorTutorName;

    public function render()
    {
        $users = User::where('role_id', 3)->where('name','like',"%{$this->search}%")->paginate(10);

        $tutorResults = [];
        if (strlen($this->editingTutorName >= 1)) {
            $tutorResults = User::where('role_id', 2)->where('name','like',"%{$this->editingTutorName}%")->limit(3)->get();
        }

        return view('livewire.allocation.allocation-page', ['users' => $users, 'tutorResults' => $tutorResults]);
    }

    public function edit($studentId)
    {
        $this->reset('errorTutorName');
        $this->editingStudentId = $studentId;
        $this->editingTutorName = User::find($studentId)->activeTutor()->name ?? "";
    }

    public function cancelEdit()
    {
        $this->reset('editingStudentId','editingTutorName');
    }

    public function update()
    {
        $student = User::find($this->editingStudentId);
        $tutorName = $this->editingTutorName;

        if ($tutorName === "") {
            $this->errorTutorName = "Please input name";
        } else {
            $tutor = User::where('name', $tutorName)->first();
            if ($tutor) {
                $student->assignOrChangeTutor($tutor->id);
                $this->cancelEdit();
                // flash message here
            } else {
                $this->errorTutorName = "User does not exist!";
            }
        }

    }

    public function toggleSelect($value)
    {
        $this->isSelectingTutor = $value;
    }

    public function selectTutor($tutorId)
    {
        $tutorName = User::where('id', $tutorId)->first()->name;
        $this->editingTutorName = $tutorName;
        $this->isSelectingTutor = false;
    }

    public function clickOutside()
    {
        $this->toggleSelect(false);
    }

    // When search-box is updated, pagination will be reset
    public function updatedSearch(){
        $this->resetPage();
    }
}
