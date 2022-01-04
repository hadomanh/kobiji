<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'ratio',
        'type',
    ];

    public function students() {
        return $this->belongsToMany('App\User' , 'student_skill', 'skill_id', 'student_id')->withTimestamps()->withPivot('grade');
    }

    public function subject() {
        return $this->belongsTo('App\Models\Subject');
    }
}
