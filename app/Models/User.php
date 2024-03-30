<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Controllers\MailController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tutors()
    {
        return $this->belongsToMany(User::class, 'student_tutor', 'student_id', 'tutor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_tutor', 'tutor_id', 'student_id');
    }

    public function activeTutor()
    {
        return $this->tutors()->wherePivot('is_current', true)->first();
    }

    public function activeStudents()
    {
        return $this->students()->wherePivot('is_current', true);
    }

    public function assignOrChangeTutor($tutorId)
    {
        $existingTutor = $this->activeTutor();

        if ($existingTutor) {
            if ($existingTutor->id === $tutorId) {
                // do nothing if the same tutor is reassigned
                return false;
            }
            $this->tutors()->updateExistingPivot($existingTutor->id, ['is_current' => false, 'updated_at' => now()]);
        } else {
            $this->tutors()->wherePivot('tutor_id', '=', null)->detach();
        }

        $this->tutors()->syncWithoutDetaching([$tutorId => ['is_current' => true, 'created_at' => now(), 'updated_at' => now()]]);

        InteractionLog::addInteractionLogEntry($this->id, $tutorId, 1, 0);
        // Send emails
        $tutor = User::find($tutorId);
        $mailController = new MailController();
        $mailController->sendTutorAssignMails($tutor, $this);
        return true;
    }

    public function meetings()
    {
        if ($this->role_id == 2) {
            return $this->hasMany(Meeting::class, 'tutor_id');
        } else {
            return $this->hasMany(Meeting::class, 'student_id');
        }
    }

    public function finishedMeetings()
    {
        return $this->meetings()->where('time', '<=', now()->subMinutes(30));
    }

    public function pendingMeetings()
    {
        return $this->meetings()->where('time', '>', now()->subMinutes(30));
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'sender_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function allPosts($relatedId)
    {
        $sentPosts = Post::where('sender_id', $this->id)->where('receiver_id', $relatedId)->get();
        $receivedPosts = Post::where('sender_id', $relatedId)->where('receiver_id', $this->id)->get();

        // Merge the two arrays and sort them by created_at date
        $allPosts = $sentPosts->merge($receivedPosts)->sortBy('created_at');

        return $allPosts;
    }

    // public function lastChats()
    // {
    //     $userId = $this->id;

    //     $lastChats = Post::whereIn('id', function ($query) use ($userId) {
    //         $query->selectRaw('MAX(id)')
    //             ->from('posts')
    //             ->where('sender_id', '=', $userId)
    //             ->orWhere('receiver_id', '=', $userId)
    //             ->groupBy('sender_id', 'receiver_id')
    //             ->havingRaw('MAX(created_at)');
    //     })
    //     ->orderBy('created_at', 'desc')
    //     ->get();

    //     return $lastChats;
    // }

    public function chats($inputText = null)
    {
        $chats = [];

        $students = $this->activeStudents;
        if ($inputText) {
            $students = $students->filter(function ($student) use ($inputText) {
                return strpos(strtolower($student->name), strtolower($inputText)) !== false;
            });
        }


        foreach ($students as $student) {
            $chat = $this->getLastChat($student->id);

            $chats[] = [
                'student' => $student,
                'chat' => $chat
            ];
        }

        usort($chats, function ($a, $b) {
            if ($a['chat'] === null && $b['chat'] !== null) {
                return 1; // $a comes after $b
            } elseif ($a['chat'] !== null && $b['chat'] === null) {
                return -1; // $a comes before $b
            } elseif ($a['chat'] !== null && $b['chat'] !== null) {
                // Compare by created_at timestamp if both chats exist
                return $b['chat']->created_at <=> $a['chat']->created_at;
            } else {
                return 0; // no change in order
            }
        });

        return $chats;
    }

    public function getLastChat($id)
    {
        return Post::where('sender_id', '=', $id)
            ->orWhere('receiver_id', '=', $id)
            ->latest('created_at')
            ->first();
    }

    public function hasUnreadMessagesByTutor()
    {
        return Notification::where('sender_id', '=', $this->id)
            ->where('receiver_id', '=', $this->activeTutor()->id)
            ->where('read_at', '=', null)
            ->exists();
    }

    public function showValues()
    {
        return [
            'sender_id' => $this->id,
            'receiver_id' => $this->activeTutor()->id,
            'noti' => $this->hasUnreadMessagesByTutor() ? 'yes' : 'no'
        ];
    }

}
