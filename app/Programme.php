<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    public function students()
    {
        return $this->hasMany('App\Student');   // a programme has many students
    }

    public function courses()
    {
        return $this->hasMany('App\Course');   // a programme has many courses
    }
}
