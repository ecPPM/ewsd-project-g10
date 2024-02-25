<?php

namespace App\Livewire\Allocation;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllocationPage extends Component
{
    use WithPagination;

    public $checkedTutor;

    public $search;

    // ------------ FOR STUDENT TABLE --------------------
    public $editingStudentId;
    public $editingTutorName;

    public $isSelectingTutor = false;

    public $errorTutorName;

    // ------------ FOR TUTOR TABLE ----------------------
    public $editingTutorId;
    public $editingStudentName;

    public $selectedStudents = [];

    public $isSelectingStudent = false;

    // ------------------------------------------------------------------
    public function render()
    {
        $data = $this->getData();

        return view('livewire.allocation.allocation-page', $data);
    }

    public function getData()
    {
        $queryResults = [];

        if($this->checkedTutor) {
            $users = User::where('role_id', 2)->where('name','like',"%{$this->search}%")->paginate(10);
            if (strlen($this->editingStudentName >= 1)) {
                $queryResults = User::where('role_id', 3)->where('name','like',"%{$this->editingStudentName}%")->limit(3)->get();
            }
        } else {
            $users = User::where('role_id', 3)->where('name','like',"%{$this->search}%")->paginate(10);
            if (strlen($this->editingTutorName >= 1)) {
                $queryResults = User::where('role_id', 2)->where('name','like',"%{$this->editingTutorName}%")->limit(3)->get();
            }
        }

        return ['users' => $users, 'queryResults' => $queryResults];
    }

    public function toggleTable()
    {
        $this->reset('search','editingStudentId','editingStudentName','editingTutorId','editingTutorName','selectedStudents');
        $this->checkedTutor = !$this->checkedTutor;
    }

    // -------------------- FOR STUDENT TABLE ----------------------------

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

    // -------------------- FOR TUTOR TABLE ----------------------------

    public function editTutor($tutorId)
    {
        $this->reset('selectedStudents');
        $this->editingTutorId = $tutorId;
    }

    public function selectStudent($studentId)
    {
        $student = User::where('id', $studentId)->first();
        $this->editingTutorName = "";
        $this->isSelectingTutor = false;
        array_push($this->selectedStudents, $student);
    }



    public function toggleStudentSelect($value)
    {
        $this->isSelectingStudent = $value;
    }

    public function clickOutsideStudentTextbox()
    {
        $this->toggleStudentSelect(false);
        $this->reset('editingStudentName');
    }

    public function deselectStudent($studentId)
    {
        $this->selectedStudents = array_filter($this->selectedStudents, function ($student) use ($studentId) {
            return $student->id != $studentId;
        });
    }

    public function cancelStudentEdit()
    {
        $this->reset('editingTutorId','editingStudentName','selectedStudents');
    }

    public function bulkUpdate()
    {

    }

    // When search-box is updated, pagination will be reset
    public function updatedSearch()
    {
        $this->resetPage();
    }

}
