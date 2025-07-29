<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\ExamMark;

class LecturerController extends Controller
{
    /**
     * Display a list of courses assigned to the lecturer.
     */
     public function myCourses()
    {
        $lecturer = Auth::user();

        if (!$lecturer || $lecturer->role !== 'lecturer') {
            abort(403, 'Unauthorized');
        }

        $courses = $lecturer->courses;

        return view('lecturer.my-courses', compact('courses'));
    }

    /**
     * Display students and their exam marks for each course.
     */
      public function examMarks()
{
    $lecturer = Auth::user();

    if (!$lecturer || $lecturer->role !== 'lecturer') {
        abort(403, 'Unauthorized');
    }

    $courses = Course::with(['students', 'examMarks'])
        ->where('lecturer_id', $lecturer->id)
        ->get();

    return view('lecturer.exam-marks', compact('courses'));
}

public function updateExamMarks(Request $request, Course $course)
{
    $marks = $request->input('marks');

    foreach ($marks as $studentId => $mark) {
        // Update or create exam mark
        $course->examMarks()->updateOrCreate(
            ['student_id' => $studentId],
            ['mark' => $mark]
        );
    }

    return redirect()->back()->with('success', 'Exam marks updated successfully.');
}

public function storeExamMarks(Request $request, Course $course)
{
    $lecturer = Auth::user();

    if ($course->lecturer_id !== $lecturer->id) {
        abort(403, 'Unauthorized action.');
    }

    foreach ($request->input('marks', []) as $studentId => $mark) {
        if ($mark !== null) {
            \App\Models\ExamMark::create([
                'student_id' => $studentId,
                'course_id' => $course->id,
                'mark' => $mark,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Marks added successfully.');
}

public function index(Course $course)
{
    $studentsWithMarks = ExamMark::where('course_id', $course->id)
        ->with('student')
        ->get();

    return view('lecturer.exam_marks.index', ['courses' => $course, 'studentsWithMarks' => $studentsWithMarks]);
}


}
