<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function programme()
    {
        return $this->belongsTo('App\Programme')->withDefault();   // a student belongs to a programme
    }

    public function studentcourses()
    {
        return $this->hasMany('App\StudentCourse');   // a course has many studentCourses
    }
}
