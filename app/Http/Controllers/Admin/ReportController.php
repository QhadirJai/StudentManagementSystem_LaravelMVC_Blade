<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\ExamMark;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function studentAverage()
    {
        $averages = Student::with('examMarks.course')
            ->get()
            ->map(function ($student) {
                $avg = $student->examMarks->avg('mark');
                return [
                    'student_name' => $student->name,
                    'average_mark' => round($avg, 2),
                ];
            });

        return view('reports.student_average', compact('averages'));
    }

    public function subjectAverage()
    {
        $averages = Course::with('examMarks')
            ->get()
            ->map(function ($course) {
                $avg = $course->examMarks->avg('mark');
                return [
                    'course_name' => $course->name,
                    'average_mark' => round($avg, 2),
                ];
            });

        return view('reports.subject_average', compact('averages'));
    }

    public function exportStudentAverage()
    {
        $csvData = "Student Name,Average Mark\n";

        $students = Student::with('examMarks')->get();
        foreach ($students as $student) {
            $avg = round($student->examMarks->avg('mark'), 2);
            $csvData .= "{$student->name},{$avg}\n";
        }

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="student_average.csv"',
        ]);
    }

    public function exportSubjectAverage()
    {
        $csvData = "Course Name,Average Mark\n";

        $courses = Course::with('examMarks')->get();
        foreach ($courses as $course) {
            $avg = round($course->examMarks->avg('mark'), 2);
            $csvData .= "{$course->name},{$avg}\n";
        }

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="subject_average.csv"',
        ]);
    }
}

