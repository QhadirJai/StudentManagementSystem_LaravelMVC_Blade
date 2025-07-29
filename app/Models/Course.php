<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;       // ✅ Importing related model
use App\Models\Student;    // ✅ Importing related model
use App\Models\ExamMark;   // ✅ Importing related model

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'credit_hour',
        'lecturer_id',
    ];

   // In Course.php
public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id');
    }

    public function examMarks()
    {
        return $this->hasMany(ExamMark::class);
    }
}
