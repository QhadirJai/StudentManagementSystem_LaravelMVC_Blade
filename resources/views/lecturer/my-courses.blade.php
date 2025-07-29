@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">My Assigned Courses</h2>

        @if($courses->isEmpty())
            <div class="alert alert-info">
                You have no assigned courses yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Course Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->code }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
