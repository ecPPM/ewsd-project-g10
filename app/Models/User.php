<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

        return true;
    }
}
