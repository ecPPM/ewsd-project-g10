<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class TutorsPage extends Component
{
    use WithPagination;

    public $search = "";

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function handleRowClick($userId)
    {
        return redirect()->to('/tutors/' . $userId);
    }

    public function render(): View
    {
        $tutors = User::where('role_id', 2)->where('name', 'like', "%{$this->search}%")->paginate(10);

        foreach ($tutors as $tutor) {
            $tutor->studentCount = $tutor->students->count();
        }

        return view('livewire.tutors-page', [
            'tutors' => $tutors,
        ]);
    }
}
