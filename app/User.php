<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'avatar',
        'active',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subjects() {
        return $this->belongsToMany('App\Models\Subject' , 'student_subject', 'student_id', 'subject_id')->withTimestamps()->withPivot('midterm', 'endterm');
    }

    public function lessons() {
        return $this->belongsToMany('App\Models\Lesson' , 'student_lesson', 'student_id', 'lesson_id')->withTimestamps()->withPivot('midterm', 'endterm');
    }

    public function skills() {
        return $this->belongsToMany('App\Models\Skill' , 'student_skill', 'student_id', 'skill_id')->withTimestamps()->withPivot('grade');
    }

    function getAverage() {
        $subjects = $this->subjects;
        if (count($subjects) == 0) {
            return 0;
        }
        $total = 0;
        foreach ($subjects as $subject) {
            if ($subject->pivot->midterm == -1 || $subject->pivot->endterm == -1) {
                continue;
            }
            $total += $subject->pivot->midterm * $subject->midterm + $subject->pivot->endterm * $subject->endterm;
        }
        return $total / count($subjects);
    }

    public function getAverageBy($subjectId)
    {
        $subject = $this->subjects()->where('subject_id', $subjectId)->first();
        if ($subject == null) {
            return 0;
        }
        $total = 0;
        foreach ($subject->skills as $skill) {
            foreach ($skill->students as $student) {
                if ($student->id == $this->id) {
                    $total += $student->pivot->grade * $skill->ratio;
                }
            }
        }

        return $total;
    }
}
