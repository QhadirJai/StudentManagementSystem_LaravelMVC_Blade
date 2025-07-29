@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Course</h2>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="code" class="form-label">Course Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="credit_hour" class="form-label">Credit Hour</label>
            <input type="number" name="credit_hour" class="form-control" required min="1" max="10">
        </div>

        <div class="mb-3">
            <label for="lecturer_id" class="form-label">Assign Lecturer</label>
            <select name="lecturer_id" class="form-select" required>
                <option value="" disabled selected>Select Lecturer</option>
                @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}">{{ $lecturer->name }} ({{ $lecturer->email }})</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Create</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
