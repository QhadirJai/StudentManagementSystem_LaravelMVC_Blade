{{-- resources/views/student/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Student List')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Student List</h2>
        <a href="{{ route('student.create') }}" class="btn btn-primary">Add Student</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>StudentID</th>
                <th>Name</th>
                <th>Class</th>
                <th>Semester</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student as $student)
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->semester }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->dob }}</td>
                    <td>
                        <a href="{{ route('student.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('student.destroy', $student) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
