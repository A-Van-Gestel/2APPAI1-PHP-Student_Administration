@extends('layouts.template')

@section('main')
    <h1>{{ $programme-> name}}</h1>

    @if($courses->count() == 0)
        <div class="alert alert-danger">
            No courses for this programme!
        </div>
    @else
        <p>Courses:</p>
        <ul>
            @foreach($courses as $course)
                <li>{{ $course->name }}</li>
            @endforeach
        </ul>
    @endif
@endsection
