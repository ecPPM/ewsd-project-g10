<?php

namespace App\Livewire\Pages\Student;

use App\Models\File;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardPage extends Component
{
    public function getData()
    {
        $messages = Post::where(function ($query) {
                $query->where('sender_id', Auth::user()->id)
                    ->orWhere('receiver_id', Auth::user()->id);
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

    // public function getNumberOfMessages()
    // {
    //     return Post::where(function ($query) {
    //             $query->where('sender_id', Auth::user()->id)
    //                 ->orWhere('receiver_id', Auth::user()->id);
    //         })->count();
    // }

    public function render()
    {
        return view('livewire.pages.student.dashboard-page', [
            'numberOfMessages' => $this->getData()['messages'],
            'numberOfFiles' => $this->getData()['files'],
        ]);
    }
}
