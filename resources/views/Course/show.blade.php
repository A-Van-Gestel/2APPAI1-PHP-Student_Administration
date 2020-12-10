@extends('layouts.template')

@section('main')
    <h1>{{ $course-> name}}</h1>
    <p>{{ $course->description }}</p>

    @if($course->studentcourses->count() == 0)
    <div class="alert alert-danger">
        No students enrolled!
    </div>
    @else
        <p>List of students enrolled:</p>
        <ul>
            @foreach($course->studentcourses as $studentcourse)
                <li>{{ $studentcourse->student->first_name }} {{ $studentcourse->student->last_name }} (semester {{ $studentcourse->semester }})</li>
            @endforeach
        </ul>
    @endif
@endsection
