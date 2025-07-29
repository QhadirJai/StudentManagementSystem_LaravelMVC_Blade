@extends('layouts.app')

@section('content')
<div class="container">
    <div class="dashboard-card">
        <h2 class="dashboard-title">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </h2>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <p class="welcome-text">
            🎉 Welcome back, <strong>{{ Auth::user()->name }}</strong>! You're successfully logged in.
        </p>

        <div class="quick-actions">
            <a href="#" class="action-button">📚 View Courses</a>
            <a href="#" class="action-button">📝 View Marks</a>
            <a href="#" class="action-button">📊 View Reports</a>
        </div>
    </div>
</div>
@endsection
