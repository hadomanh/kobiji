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

    function getAverage() {
        $subjects = $this->subjects;
        $total = 0;
        foreach ($subjects as $subject) {
            $total += $subject->pivot->midterm * $subject->midterm + $subject->pivot->endterm * $subject->endterm;
        }
        return $total / count($subjects);
    }
}
