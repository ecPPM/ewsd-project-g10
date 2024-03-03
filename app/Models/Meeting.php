<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'student_id',
        'tutor_id',
        'mode',
        'time',
        'location',
        'platform',
        'invitation_link',
        'is_cancelled',
        'notes',
    ];


}
