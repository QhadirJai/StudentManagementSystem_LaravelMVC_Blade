@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Exam Marks</h2>
    @foreach ($courses as $course)
        <h4>{{ $course->name }}</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Mark</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentsWithMarks as $data)
    <tr>
        <td>{{ $data->student->name }}</td>
        <td>{{ $data->mark }}</td>
        <td>
            <a href="{{ route('lecturer.exam-marks.edit', [$course->id, $data->id]) }}">Edit</a>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
