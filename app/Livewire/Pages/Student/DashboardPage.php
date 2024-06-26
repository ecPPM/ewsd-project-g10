<?php

namespace App\Livewire\Pages\Student;

use App\Models\File;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardPage extends Component
{
    public $modalOpen;

    public function mount()
    {
        if (Auth::user()->first_login) {
            $this->modalOpen = true;
        } else {
            $this->modalOpen = false;
        }
    }

    public function closeFirstLoginModal()
    {
        $user = User::find(Auth::user()->id);

        if ($user) {
            $user->first_login = false;
            $user->save();
        }

        $this->modalOpen = false;
    }

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

    public function render()
    {
        $data = $this->getData();

        return view('livewire.pages.student.dashboard-page', [
            'numberOfMessages' => $data['messages'],
            'numberOfFiles' => $data['files'],
        ]);
    }
}
