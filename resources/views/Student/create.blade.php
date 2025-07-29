@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">🎓 Register Student</h3>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>⚠️ {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('student.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="e.g., STU123" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                        </div>

                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>
                            <input type="text" class="form-control" id="class" name="class" placeholder="e.g., CS110" required>
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="number" min="1" max="8" class="form-control" id="semester" name="semester" placeholder="1 - 8" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="john@email.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone (Optional)</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="012-3456789">
                        </div>

                        <div class="mb-4">
                            <label for="dob" class="form-label">Date of Birth (Optional)</label>
                            <input type="date" class="form-control" id="dob" name="dob">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                🚀 Submit Registration
                            </button>
                        </div>
                    </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div>
    </div>
</div>
@endsection
