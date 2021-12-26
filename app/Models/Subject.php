<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'code',
        'teacher',
        'target',
        'session',
        'description',
        'midterm',
        'endterm',
        'limit',
    ];

    public function students() {
        return $this->belongsToMany('App\User' , 'student_subject', 'subject_id', 'student_id')->withTimestamps()->withPivot('midterm', 'endterm', 'attendance');
    }

    public function lessons() {
        return $this->hasMany('App\Models\Lesson');
    }

    public function skills() {
        return $this->hasMany('App\Models\Skill');
    }
}
