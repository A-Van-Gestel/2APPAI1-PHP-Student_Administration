<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    public function student()
    {
        return $this->hasMany('App\Student');   // a studentCourse belongs to a student
    }

    public function course()
    {
        return $this->belongsTo('App\Course')->withDefault();   // a studentCourse belongs to a course
    }
}
