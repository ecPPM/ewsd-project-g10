<?php

namespace App\Livewire\Pages\Tutor;

use App\Models\File;
use App\Models\InteractionLog;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class TutorBlogPage extends Component
{
    use WithFileUploads;

    public $selectedStudentId = "default";
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

        InteractionLog::addInteractionLogEntry(null, Auth::user()->id, 9, $post->id);

        // Upload files if there are files
        if (!empty($this->files)) $this->uploadFile('post',$post->id);

        // success flash message


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

            InteractionLog::addInteractionLogEntry(null, Auth::user()->id, 15, $savedFile->id);
        }

    }

    public function render()
    {
        $posts = Auth::user()->allPosts($this->selectedStudentId);
        // foreach($posts as $post) {
        //     $relatedFiles = $post->files;
        // }


        return view('livewire.pages.tutor.tutor-blog-page', [
            'posts' => $posts,
            'activeStudents' => Auth::user()->activeStudents
        ]);
    }
}
