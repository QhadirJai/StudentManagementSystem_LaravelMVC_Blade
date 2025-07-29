@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}!</p>

    <div class="row mt-4">
        @if(Auth::user()->role === 'admin')
            <!-- Admin View: 3 Cards -->
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">
                        <i class="fas fa-user-graduate"></i> Total Students
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $studentCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">
                        <i class="fas fa-chalkboard-teacher"></i> Total Lecturers
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $lecturerCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <i class="fas fa-book"></i> Total Subjects
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $courseCount }}</h5>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->role === 'lecturer')
            <!-- Lecturer View: 2 Cards -->
            <div class="col-md-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">
                        <i class="fas fa-user-graduate"></i> My Students
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $studentCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <i class="fas fa-book"></i> My Courses
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $courseCount }}</h5>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if(Auth::user()->role === 'admin')
        <!-- Pie Chart (Admin Only) -->
        <div class="row mt-4">
            <div class="col-md-6">
                <canvas id="dashboardPieChart"></canvas>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    @if(Auth::user()->role === 'admin')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('dashboardPieChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Students', 'Lecturers', 'Subjects'],
                    datasets: [{
                        label: 'Dashboard Data',
                        data: [{{ $studentCount }}, {{ $lecturerCount }}, {{ $courseCount }}],
                        backgroundColor: ['#17a2b8', '#28a745', '#ffc107'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>
    @endif
@endsection
