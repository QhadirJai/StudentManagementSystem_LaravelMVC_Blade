@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Students to Courses</h2>

    {{-- Table to assign students --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Name</th>
                <th>Lecturer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->lecturer?->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('courses.assign.students.form', $course->id) }}" class="btn btn-sm btn-primary">
                            Assign Students
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Check if the user is Admin --}}
@if(auth()->user()->role === 'admin')
    <hr>
    <h4>View Students by Course & Lecturer</h4>

    <form action="{{ route('courses.view.students') }}" method="GET">
        <div class="form-group">
            <label for="lecturer_id">Lecturer</label>
            <select name="lecturer_id" class="form-control" required>
                <option value="">-- Select Lecturer --</option>
                @foreach($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}" {{ request('lecturer_id') == $lecturer->id ? 'selected' : '' }}>
                        {{ $lecturer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="course_id">Course</label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-info mt-3">View Students</button>
    </form>

    {{-- Show student table --}}
    @if(isset($students))
        <hr>
        <h4 class="mt-4">Student List</h4>

        @if(count($students) > 0)
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mt-3">No students found for selected course and lecturer.</div>
        @endif
    @endif
@endif

@endsection
