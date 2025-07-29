<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;

class DashboardController extends Controller
{
   public function index()
{
    if (Auth::user()->role === 'admin') {
        $studentCount = Student::count();
        $lecturerCount = User::where('role', 'lecturer')->count();
        $courseCount = Course::count();
    } else {
        // Use Auth::id() since lecturers are stored in 'users' table
        $lecturerId = Auth::id();

        // Count courses assigned to this lecturer
        $courseCount = Course::where('lecturer_id', $lecturerId)->count();

        // Count students who are enrolled in the lecturer's courses
        $studentCount = Student::whereHas('courses', function ($q) use ($lecturerId) {
            $q->where('lecturer_id', $lecturerId);
        })->count();

        $lecturerCount = null; // not applicable for lecturer dashboard
    }

    return view('dashboard', compact('studentCount', 'lecturerCount', 'courseCount'));
}

}
