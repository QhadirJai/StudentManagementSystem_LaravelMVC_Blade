@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Average Marks per Subject</h2>
    <a href="{{ route('reports.subjects.export') }}" class="btn btn-sm btn-primary mb-3">Export CSV</a>
    <table class="table">
        <thead><tr><th>Course Name</th><th>Average Mark</th></tr></thead>
        <tbody>
            @foreach ($averages as $data)
                <tr>
                    <td>{{ $data['course_name'] }}</td>
                    <td>{{ $data['average_mark'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
