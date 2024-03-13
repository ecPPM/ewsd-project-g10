<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InteractionLog extends Model
{
    protected $fillable = [
        'student_id',
        'tutor_id',
        'interaction_id',
        'related_id',
    ];

    protected $table = 'interaction_logs'; // Adjust table name as needed

    public static function addInteractionLogEntry($studentId, $tutorId, $interactionId, $relatedId)
    {
        self::create([
            'student_id' => $studentId,
            'tutor_id' => $tutorId,
            'interaction_id' => $interactionId,
            'related_id' => $relatedId,
        ]);
    }
}
