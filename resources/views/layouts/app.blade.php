<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS</title>

    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar .nav-link {
            color: #fff;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #fff;
        }
    </style>
</head>

<body>
    @php
        $authRoutes = ['login', 'register', 'password.request', 'password.email', 'password.reset'];
    @endphp

    @if (!in_array(Route::currentRouteName(), $authRoutes))
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}">
                    SMS
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">{{ __('Logout') }}</button>
                                </form>
                            </div>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    @endif

    <div class="container-fluid">
        <div class="row">
            @if (!in_array(Route::currentRouteName(), $authRoutes))
                <!-- Sidebar -->
                <div class="col-md-2 sidebar p-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        @auth
                            @if (Auth::user()->role === 'admin')
                                <!-- Admin Links -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('student.index') }}">Students</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.lecturers.index') }}">Lecturers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('courses.assign.list') }}">Student Courses</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="reportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Reports
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="reportDropdown">
                                        <li><a class="dropdown-item" href="{{ route('reports.students') }}">Student Report</a></li>
                                        <li><a class="dropdown-item" href="{{ route('reports.subjects') }}">Subject Report</a></li>
                                    </ul>
                                </li>
                            @elseif (Auth::user()->role === 'lecturer')
                                <!-- Lecturer Links -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('lecturer.my-courses') }}">My Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('lecturer.exam-marks') }}">Exam Marks</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            @endif

            <!-- Main Content -->
            <div class="{{ in_array(Route::currentRouteName(), $authRoutes) ? 'col-md-12' : 'col-md-10' }} p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
