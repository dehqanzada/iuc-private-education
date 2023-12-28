@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        @foreach ($students ?? [] as $student)
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $student->name }}</h5>
                    <div>
                        <a href="{{ route('experiences.index', ['student_id' => $student->id]) }}" class="btn btn-sm btn-primary">New Experience</a>
                        <a href="{{ route('experiences.show', [$student->id]) }}" class="btn btn-sm btn-secondary">Reports</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
