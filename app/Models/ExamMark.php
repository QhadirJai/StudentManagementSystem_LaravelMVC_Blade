<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    protected $fillable = [
    'student_id',
    'course_id',
    'mark',
];
    public function student()
{
    return $this->belongsTo(Student::class);
}

public function course()
{
    return $this->belongsTo(Course::class);
}

}
