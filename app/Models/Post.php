<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'content',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function files()
    {
        return File::where('fileable_type', 'post')->where('fileable_id', $this->id)->get();
    }

    public function delete()
    {
        // Delete associated comments
        $this->comments()->delete();

        // Delete associated files
        $this->files()->delete();

        // Delete the post
        return parent::delete();
    }
}
