@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Assign Students to <strong>{{ $course->name }}</strong></h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <form action="{{ route('courses.assign.students', $course->id) }}" method="POST">
    @csrf

    <label for="student_ids">Select Students:</label>
    <select name="student_ids[]" multiple class="form-control" required>
        @foreach ($students as $student)
            <option value="{{ $student->id }}" {{ in_array($student->id, $assignedStudentIds) ? 'selected' : '' }}>
                {{ $student->name }} ({{ $student->email }})
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary mt-2">Assign</button>
</form>

@endsection
