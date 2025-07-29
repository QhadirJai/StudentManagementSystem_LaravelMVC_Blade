@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Course</h2>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="code" class="form-label">Course Code</label>
            <input type="text" name="code" class="form-control" value="{{ $course->code }}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
        </div>


        <div class="mb-3">
            <label for="credit_hour" class="form-label">Credit Hour</label>
            <input type="number" name="credit_hour" class="form-control" value="{{ $course->credit_hour }}" min="1" max="10" required>
        </div>

        <div class="mb-3">
            <label for="lecturer_id" class="form-label">Assigned Lecturer</label>
            <select name="lecturer_id" class="form-select" required>
                <option value="" disabled>Select Lecturer</option>
                @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}" {{ $course->lecturer_id == $lecturer->id ? 'selected' : '' }}>
                        {{ $lecturer->name }} ({{ $lecturer->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
