@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Enter Exam Mark</h2>

    <form method="POST" action="{{ route('lecturer.exam-marks.store') }}">
        @csrf
        <div class="mb-3">
            <label>Course</label>
            <select name="course_id" class="form-control">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control">
                @foreach ($courses as $course)
                    @foreach ($course->students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }} ({{ $course->name }})</option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Mark</label>
            <input type="number" name="mark" class="form-control" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
