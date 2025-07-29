@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Courses</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Add Course</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Credit Hour</th>
                <th>Lecturer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courses as $course)
                <tr>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->credit_hour }}</td>
                    <td>{{ $course->lecturer->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this course?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
