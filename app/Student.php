<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function programme()
    {
        return $this->belongsTo('App\Programme')->withDefault();   // a student belongs to a programme
    }

    public function studentcourses()
    {
        return $this->hasMany('App\StudentCourse');   // a student has many studentCourses
    }
}
