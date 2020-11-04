<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Master Page: http://student_administration.test/courses or http://localhost:3000/courses
    public function index()
    {
        return view('Course.index');
    }

    // Detail Page: http://student_administration.test/courses/{id} or http://localhost:3000/courses/{id}
    public function show($id)
    {
        return view('Course.show', ['id' => $id]);  // Send $id to the view
    }
}
