<?php

namespace App\Livewire\Pages\Student;

use App\Models\File;
use App\Models\InteractionLog;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class StudentBlogPage extends Component
{
    use WithFileUploads;

    public $editingText;
    public $files = [];

    public function send()
    {
        $post = Post::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => Auth::user()->activeTutor()->id,
            'content' => $this->editingText
        ]);

        InteractionLog::addInteractionLogEntry(Auth::user()->id, null, 9, $post->id);

        // Upload files if there are files
        if (!empty($this->files)) $this->uploadFile('post',$post->id);

        // success flash message


        // Create notification
        $this->makeNotification();
    }

    public function uploadFile($fileableType, $fileableId)
    {
        foreach ($this->files as $file) {
            // Generate a unique name for the file
            $fileName = uniqid() . '_' . $file->getClientOriginalName();

            // Store the file in the storage/app directory
            Storage::putFileAs('/public', $file, $fileName);

            // Create a record in the database
            $savedFile = File::create([
                'user_id' => Auth::user()->id,
                'fileable_type' => $fileableType,
                'fileable_id' => $fileableId,
                'name' => $file->getClientOriginalName(),
                'path' => $fileName
            ]);

            InteractionLog::addInteractionLogEntry(Auth::user()->id, null, 15, $savedFile->id);
        }

    }

    public function makeNotification()
    {
        Notification::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => Auth::user()->activeTutor()->id,
            'message' => "New message from student",
        ]);
    }

    public function render()
    {
        $posts = Auth::user()->allPosts(Auth::user()->activeTutor()->id);
        return view('livewire.pages.student.student-blog-page', [
            'posts' => $posts,
        ]);
    }
}
