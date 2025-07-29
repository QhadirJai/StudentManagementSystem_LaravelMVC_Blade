@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Exam Marks</h2>

    @foreach ($courses as $course)
        <div class="card mb-4">
            <div class="card-header font-bold text-lg">
                {{ $course->name }}
            </div>

            <div class="card-body">
                <h5>📋 Students with Marks</h5>
                <table class="table mb-4">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Mark</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->students as $student)
                            @php
                                $mark = $student->examMarks->where('course_id', $course->id)->first();
                            @endphp
                            @if ($mark)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <form action="{{ route('lecturer.exam-marks.update', [$course->id, $mark->id]) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="mark" value="{{ $mark->mark }}" min="0" max="100" class="form-control" style="width: 100px; margin-right: 10px;">
                                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('lecturer.exam-marks.destroy', [$course->id, $mark->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this mark?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <h5>🆕 Students without Marks</h5>
                <form action="{{ route('lecturer.exam-marks.store', $course->id) }}" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->students as $student)
                                @php
                                    $mark = optional($student->examMarks)->where('course_id', $course->id)->first();
                                @endphp
                                @if (!$mark)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            <input type="number" name="marks[{{ $student->id }}]" class="form-control" min="0" max="100">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mt-2">Give Mark</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
