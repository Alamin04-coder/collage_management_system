<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    
    protected $fillable = [
        'course_id',
        'teacher_id',
        'student_id',
        'phone',
        'email',
    ];

    public function course()
    {
        return $this ->belongsTo(Course::class);

    }
    public function student()
    {
        return $this ->belongsTo(Student::class);
    }
    public function teacher(){
        return $this ->belongsTo(Teacher::class);
    }
}
