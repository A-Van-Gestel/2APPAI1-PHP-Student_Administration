@extends('layouts.template')

@section('title', 'programmes')

@section('main')
    <h1>Programmes</h1>
    @include('shared.alert')
    <p>
        <a href="/admin/programmes/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Create new programme
        </a>
    </p>

    <ul class="list-group">
        @foreach($programmes as $programme)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="programmes/{{ $programme->id }}">{{ $programme->name }}</a>

                <form action="/admin/programmes/{{ $programme->id }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="btn-group btn-group-sm">
                        <a href="/admin/programmes/{{ $programme->id }}/edit" class="btn btn-outline-success"
                           data-toggle="tooltip"
                           title="Edit {{ $programme->name }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-outline-danger deleteProgramme"
                                data-toggle="tooltip"
                                data-courses="{{ $programme->courses_count }}"
                                data-name="{{ $programme->name }}"
                                title="Delete {{ $programme->name }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </form>
            </li>
        @endforeach
    </ul>
@endsection

@section('script_after')
    <script>
        $(function () {
            $('.deleteProgramme').click(function () {
                let name = $(this).data('name');
                let courses = $(this).data('courses');
                let msg = `Delete the programme '${name}'?`;
                if (courses > 0) {
                    msg += `\nThe ${courses} courses of this programme will also be deleted!`
                }
                if(confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        });
    </script>
@endsection
