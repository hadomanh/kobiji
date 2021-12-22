<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'time',
    ];

    public function subject() {
        return $this->belongsTo('App\Models\Subject');
    }

    public function students() {
        return $this->belongsToMany('App\User' , 'student_lesson', 'lesson_id', 'student_id')->withTimestamps()->withPivot('status');
    }
}
