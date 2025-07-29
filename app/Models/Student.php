<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
     protected $table = 'student';
    use HasFactory;
    protected $fillable=[
        'student_id',
        'name',
        'class',
        'semester',
        'email',
        'phone',
        'dob',
    ];

    public function courses()
{
    return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
}

public function examMarks()
{
    return $this->hasMany(ExamMark::class);
}


}
