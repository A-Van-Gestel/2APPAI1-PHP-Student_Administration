@extends('layouts.template')

@section('title', 'Courses')

@section('css_after')
@endsection


@section('main')
    <h1>Courses</h1>
    {{-- Search function --}}
    <form method="get" action="/courses" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="search" id="search"
                       value="{{ request()->search }}"
                       placeholder="Filter Course Name Or Description">
            </div>
            <div class="col-sm-4 mb-2">
                <select class="form-control" name="programme_id" id="programme_id">
                    <option value="%">All programmes</option>
                    @foreach($programmes as $programme)
                        <option value="{{ $programme->id }}"
                            {{ (request()->programme_id ==  $programme->id ? 'selected' : '')}}>{{ $programme->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2 mb-2">
                <button type="submit" class="btn btn-success btn-block">Search</button>
            </div>
        </div>
    </form>
    <hr>
    {{-- Search function - feedback if empty --}}
    @if ($courses->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Can't find any course with <b>'{{ request()->search }}'</b> for the programme
            @foreach($programmes as $programme)
                @if (request()->programme_id == $programme->id)
                    <b>{{ $programme->name }}</b>
                @endif
            @endforeach

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    {{-- Main Dashboard --}}
    <div class="row">
        @foreach($courses as $course)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card h-100" data-id="{{ $course->id }}">
                    <div class="card-body h-100 d-flex flex-row flex-wrap">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text">{{ $course->description }}</p>
                        <p class="card-text text-primary align-self-end">{{ $course->programme->name }}</p>
                    </div>
                    @auth
                        <div class="card-footer d-flex justify-content-between">
                            <a href="courses/{{ $course->id }}" class="btn btn-primary btn-block">Manage students</a>
                        </div>
                    @endauth
            </div>
            </div>
        @endforeach
    </div>

@endsection


@section('script_after')
    <script>
        $(function () {
            // submit form when leaving text field 'search'
            $('#search').blur(function () {
                $('#searchForm').submit();
            });
            // submit form when changing dropdown list 'programme_id'
            $('#programme_id').change(function () {
                $('#searchForm').submit();
            });
        })
    </script>
@endsection
