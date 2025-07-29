<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        $student = Student:: all();
        return view('student.index',['student'=> $student]);
    }

    public function create(){
        return view('student.create');
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'student_id' => 'required|string',
        'name' => 'required|string',
        'class' => 'required|string',
        'semester' => 'required|string',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'dob' => 'nullable|date',
    ]);

    $newStudent = Student::create($data);

    return redirect()->route('student.index')->with('success', 'Student created successfully!');
}

public function edit(Student $student){
    return view('Student.edit',['student' => $student]);
}

public function update(Request $request, $id)
{
    $data = $request->validate([
        'student_id' => 'required|string',
        'name' => 'required|string',
        'class' => 'required|string',
        'semester' => 'required|string',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'dob' => 'nullable|date',
    ]);

    $student = Student::findOrFail($id); // Find the student by ID
    $student->update($data);             // Then update using instance

    return redirect()->route('student.index')->with('success', 'Student updated successfully!');
}
  public function destroy(Student $student)
{
    $student->delete();
    return redirect()->route('student.index')->with('success', 'Student deleted successfully!');        

}
}
