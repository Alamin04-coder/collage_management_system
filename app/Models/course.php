<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    //
    protected $guarded = [];

   public function enrollment(){
    return $this->hasMany(CourseEnrollment::class);
   }

   public function student(){
    return $this->belongsToMany(Student::class,'course_enrollment','course_id','student_id')
    ->withPivot('teacher_id','id')
    ->timestamps();
   }

   public function teachers(){
    return $this->belongsToMany(Teacher::class,'course_enrollment','course_id','teacher_id')
    ->withPivot('teacher_id','id')
    ->timestamps();
   }

}
