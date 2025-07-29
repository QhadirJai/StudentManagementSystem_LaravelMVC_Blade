@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Lecturer</h2>

    <form action="{{ route('lecturers.update_lecturer', $lecturer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" value="{{ $lecturer->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" value="{{ $lecturer->email }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
