<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Lecturer\ExamMarkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student Routes
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{student}/update', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');

    // Lecturer Routes via LecturerController (used by lecturers themselves)
  
    Route::get('/lecturer/my-courses', [LecturerController::class, 'myCourses'])->name('lecturer.my-courses');
    Route::get('/lecturer/exam-marks', [LecturerController::class, 'examMarks'])->name('lecturer.exam-marks');
    Route::post('/lecturer/exam_marks/{course}', [LecturerController::class, 'updateExamMarks'])->name('lecturer.exam-marks.update');
    Route::post('/lecturer/exam-marks/{course}', [LecturerController::class, 'storeExamMarks'])->name('lecturer.exam-marks.store');
    Route::get('lecturer/exam-marks/{course}/{examMark}/edit', [ExamMarkController::class, 'edit'])->name('lecturer.exam-marks.edit');



    // Course Routes
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::get('/courses/assign-list', [CourseController::class, 'assignList'])->name('courses.assign.list');
    Route::get('/courses/{course}/assign-students', [CourseController::class, 'assignStudentsForm'])->name('courses.assign.students.form');
    Route::post('/courses/{course}/assign-students', [CourseController::class, 'assignStudents'])->name('courses.assign.students');
   


    
    //Exam Routes
   Route::prefix('lecturer')->name('lecturer.')->middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('exam_marks/{course}', [ExamMarkController::class, 'index'])->name('exam-marks.index');
    Route::get('exam_marks/{course}/edit/{examMark}', [ExamMarkController::class, 'edit'])->name('exam-marks.edit');
    Route::put('exam_marks/{course}/update/{examMark}', [ExamMarkController::class, 'update'])->name('exam-marks.update');
    Route::delete('exam_marks/{course}/delete/{examMark}', [ExamMarkController::class, 'destroy'])->name('exam-marks.destroy');

});

    // Admin-Only Routes for Managing Lecturers
    Route::prefix('admin/lecturers')->middleware('auth')->group(function () {
        Route::get('/', [UserController::class, 'indexLecturer'])->name('admin.lecturers.index');
        Route::get('/create', [UserController::class, 'createLecturer'])->name('admin.lecturers.create');
        Route::post('/', [UserController::class, 'storeLecturer'])->name('admin.lecturers.store');
        Route::get('/{lecturer}/edit', [UserController::class, 'editLecturer'])->name('admin.lecturers.edit');
        Route::put('/{lecturer}', [UserController::class, 'updateLecturer'])->name('admin.lecturers.update');
        Route::delete('/{lecturer}', [UserController::class, 'destroyLecturer'])->name('admin.lecturers.destroy');
    });

    

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/reports/students', [ReportController::class, 'studentAverage'])->name('reports.students');
    Route::get('/reports/subjects', [ReportController::class, 'subjectAverage'])->name('reports.subjects');
    Route::get('/reports/students/export', [ReportController::class, 'exportStudentAverage'])->name('reports.students.export');
    Route::get('/reports/subjects/export', [ReportController::class, 'exportSubjectAverage'])->name('reports.subjects.export');
   Route::get('/courses/view-students', [CourseController::class, 'viewStudents'])
    ->name('courses.view.students');

});