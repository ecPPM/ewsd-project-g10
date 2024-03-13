<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'student_id',
        'tutor_id',
        'title',
        'mode',
        'time',
        'location',
        'platform',
        'invitation_link',
        'student_response',
        'description',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}
