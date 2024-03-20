<?php

namespace App\Livewire\Pages\Tutor;

use App\Models\File;
use App\Models\InteractionLog;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TutorBlogPage extends Component
{
    public $selectedStudentId;
    public $editingText;
    public $files = [];

    public $newPostMode = false;

    public function toggleNewPost()
    {
        $this->reset(['editingText','files']);
        $this->newPostMode = !$this->newPostMode;
    }

    public function savePost()
    {
        $post = Post::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $this->selectedStudentId,
            'content' => $this->editingText
        ]);

        // Upload files if there are files
        if (!empty($this->files)) $this->uploadFile('post',$post->id);

        // success flash message

        InteractionLog::addInteractionLogEntry($this->selectedStudentId, Auth::user()->id, 9, $post->id);
    }

    public function uploadFile($fileableType, $fileableId)
    {
        foreach ($this->files as $file) {
            // Generate a unique name for the file
            $fileName = uniqid() . '_' . $file->getClientOriginalName();

            // Store the file in the storage/app directory
            Storage::putFileAs('files', $file, $fileName);

            // Create a record in the database
            File::create([
                'user_id' => Auth::user()->id,
                'fileable_type' => $fileableType,
                'fileable_id' => $fileableId,
                'name' => $file->getClientOriginalName(),
                'path' => 'storage/app/files/' . $fileName
            ]);
        }
    }

    public function render()
    {
        $posts = Auth::user()->allPosts($this->selectedStudentId);

        return view('livewire.pages.tutor.tutor-blog-page', [
            'posts' => $posts,
            'activeStudents' => Auth::user()->activeStudents
        ]);
    }
}
