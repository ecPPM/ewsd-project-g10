<?php

namespace App\Livewire\Pages\Admin;

use App\Models\File;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class StudentDetailsPage extends Component
{

    public $studentId;

    public function mount($studentId)
    {
        $this->studentId = $studentId;
    }

    public function getData()
    {
        $messages = Post::where(function ($query) {
                $query->where('sender_id', $this->studentId)
                    ->orWhere('receiver_id', $this->studentId);
            });

        $messageIds = $messages->pluck('id')->toArray();

        $numberOfFiles = File::whereIn('fileable_id', $messageIds)
            ->where('fileable_type', 'post')
            ->count();

        return [
            "messages" => $messages->count(),
            "files" => $numberOfFiles
        ];
    }


    public function render()
    {
        $student = User::where('id', $this->studentId)->first();
        $data = $this->getData();

        return view('livewire.pages.admin.student-details-page', [
            'student' => $student,
            'numberOfMessages' => $data['messages'],
            'numberOfFiles' => $data['files'],
        ]);
    }
}
