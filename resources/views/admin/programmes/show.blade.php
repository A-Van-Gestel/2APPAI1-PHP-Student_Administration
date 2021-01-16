@extends('layouts.template')

@section('main')
    <h1>{{ $programme->name}}</h1>

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
    <h1>Add a new course to {{ $programme-> name}}</h1>
    <form action="/admin/programmes/{{ $programme->id }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   minlength="3"
                   value="{{ old('name') }}"
                   required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description"
                   class="form-control @error('description') is-invalid @enderror"
                   placeholder="Description"
                   minlength="3"
                   value="{{ old('description') }}"
                   required>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <input type="hidden" id="programme_id" name="programme_id" value="{{ $programme->id }}">
        <button type="submit" class="btn btn-success">Add course</button>
    </form>
@endsection
