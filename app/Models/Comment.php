<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    public function files()
    {
        return File::where('fileable_type', 'comment')->where('fileable_id', $this->id)->get();
    }

    public function delete()
    {
        // Delete associated files
        $this->files()->delete();

        // Delete the comment
        return parent::delete();
    }
}
