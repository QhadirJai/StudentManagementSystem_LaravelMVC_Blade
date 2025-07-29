@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lecturers</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.lecturers.create') }}" class="btn btn-primary mb-3">Add Lecturer</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lecturers as $lecturer)
                <tr>
                    <td>{{ $lecturer->name }}</td>
                    <td>{{ $lecturer->email }}</td>
                    <td>
                        <a href="{{ route('admin.lecturers.edit', $lecturer) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.lecturers.destroy', $lecturer) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
