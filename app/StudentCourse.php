<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    public function students()
    {
        return $this->hasMany('App\Students');   // a studentCourse has many students
    }

    public function course()
    {
        return $this->belongsTo('App\Course')->withDefault();   // a studentCourse belongs to a course
    }
}
