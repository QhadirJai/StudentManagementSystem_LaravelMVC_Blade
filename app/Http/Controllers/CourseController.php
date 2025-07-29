<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
{
    $lecturers = User::where('role', 'lecturer')->get(); // or whatever role-check you're using
    return view('courses.create', compact('lecturers'));
}

    public function store(Request $request)
{
    $request->validate([
        'code' => 'required|unique:courses',
        'name' => 'required',
        'credit_hour' => 'required|integer',
        'lecturer_id' => 'required|exists:users,id',
    ]);

    Course::create([
        'code' => $request->code,
        'name' => $request->name,
        'credit_hour' => $request->credit_hour,
        'lecturer_id' => $request->lecturer_id,
    ]);

    return redirect()->route('courses.index')->with('success', 'Course created successfully!');
}


   public function edit(Course $course)
{
    $lecturers = User::where('role', 'lecturer')->get();
    return view('courses.edit', compact('course', 'lecturers'));
}


    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required|unique:courses,code,' . $course->id,
            'name' => 'required',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

// GET form
public function assignStudentsForm(Course $course)
{
    $students = Student::all(); // Fetch all from 'student' table
    $assignedStudentIds = $course->students()->pluck('student.id')->toArray(); // Use correct column

    return view('courses.assign-students', compact('course', 'students', 'assignedStudentIds'));
}

// POST assign students
public function assignStudents(Request $request, Course $course)
{
    $request->validate([
        'student_ids' => 'required|array',
        'student_ids.*' => 'exists:student,id', // 👈 Table is 'student', not 'students'
    ]);

    $course->students()->syncWithoutDetaching($request->student_ids);

    return redirect()->route('courses.index')->with('success', 'Students assigned successfully!');
}

// Course list for assignment
public function assignList()
{
    $courses = Course::with('lecturer')->get();
    $lecturers = \App\Models\User::where('role', 'lecturer')->get();

    // No students on initial load
    $students = null;

    return view('courses.assign-list', compact('courses', 'lecturers', 'students'));
}

public function viewStudents(Request $request)
{
   

    $courses = Course::with('lecturer')->get();
    $lecturers = \App\Models\User::where('role', 'lecturer')->get();

    $students = null;

    if ($request->filled(['lecturer_id', 'course_id'])) {
        $students = \App\Models\Student::whereHas('courses', function ($query) use ($request) {
            $query->where('courses.id', $request->course_id)
                  ->where('courses.lecturer_id', $request->lecturer_id);
        })->get();
    }

    return view('courses.assign-list', compact('courses', 'lecturers', 'students'));
}


}
