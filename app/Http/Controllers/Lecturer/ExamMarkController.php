<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\ExamMark;
use Illuminate\Http\Request;

class ExamMarkController extends Controller
{
 public function index()
{
   $lecturer = Auth::user(); 

    // Get courses assigned to the lecturer
    $courses = $lecturer->courses;

    // Get all marks related to these courses
    $studentsWithMarks = ExamMark::whereIn('course_id', $courses->pluck('id'))
        ->with(['student', 'course'])
        ->get()
        ->groupBy('course_id'); // Group by course

    return view('lecturer.exam_marks.index', compact('courses', 'studentsWithMarks'));
}



    public function edit(Course $course, ExamMark $examMark)
    {
        return view('lecturer.exam_marks.edit', compact('examMark', 'course'));
    }

    public function update(Request $request, Course $course, ExamMark $examMark)
    {
        $request->validate([
            'mark' => 'required|numeric|min:0|max:100',
        ]);

        $examMark->update([
            'mark' => $request->mark,
        ]);

        return redirect()->route('lecturer.exam-marks.index', $course->id)
            ->with('success', 'Mark updated successfully.');
    }

public function destroy(Course $course, ExamMark $examMark)
{
    $examMark->delete();

    return redirect()->route('lecturer.exam-marks.index', $course->id)
        ->with('success', 'Mark deleted successfully.');
}


}

