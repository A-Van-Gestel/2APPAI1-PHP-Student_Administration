<?php

namespace App\Http\Controllers;

use App\Course;
use App\Programme;
use Illuminate\Http\Request;
use Json;

class CourseController extends Controller
{
    // Master Page: http://student_administration.test/courses or http://localhost:3000/courses
    public function index(Request $request)
    {
        // Get input from form
        $search_programme_id = $request->input('programme_id') ?? '%';
        $search_course = '%' . $request->input('search') . '%';

        // Make programmes list for Filter
        $programmes = Programme::orderBy('name')
        ->has('courses')        // only genres that have one or more records
        ->withCount('courses')  // add a new property 'records_count' to the Genre models/objects
        ->get()
            ->transform(function ($item, $key) {
                // Set name to uppercase
                $item->name = strtoupper($item->name);
                // Remove all fields that you don't use inside the view
                unset($item->created_at, $item->updated_at);
                return $item;
            });


        $courses = Course::with('programme')
            ->where(function ($query) use ($search_course, $search_programme_id) {
                $query->where('name', 'like', $search_course)
                    ->where('programme_id', 'like', $search_programme_id);
            })
            ->orWhere(function ($query) use ($search_course, $search_programme_id) {
                $query->where('description', 'like', $search_course)
                    ->where('programme_id', 'like', $search_programme_id);
            })
            ->orderBy('name')
            ->get()
            ->transform(function ($item, $key) {
                // Set name to uppercase
                $item->programme->name = strtoupper($item->programme->name);
                // Remove all fields that you don't use inside the view
                unset($item->created_at, $item->updated_at);
                return $item;
            })
            ->append(['name'=> $request->input('search'), 'programme_id' => $request->input('programme_id')]);



        $result = compact('courses', 'programmes');
        Json::dump($result);
        return view('Course.index', $result);
    }

    // Detail Page: http://student_administration.test/courses/{id} or http://localhost:3000/courses/{id}
    public function show($id)
    {
        // Make get record by ID
        $course = Course::with('programme')
            ->with('studentcourses')
            ->with('studentcourses.student')
            ->findOrFail($id);
        // dd($course);

        // Send to page
        $result = compact('course');
        Json::dump($result);                    // open http://vinyl_shop.test/shop/{{ ID }}?json
        return view('Course.show', $result);  // Pass $result to the view
    }
}
