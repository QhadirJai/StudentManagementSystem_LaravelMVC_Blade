@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Lecturer</h2>

    <form action="{{ route('admin.lecturers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-success">Create</button>
    </form>
</div>
@endsection
