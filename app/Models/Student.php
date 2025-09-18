<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    

      public function user()
      {
          return $this->belongsTo(User::class);
      }

    protected $fillable = [
        'user_id',
        'name',
        'session',
        'department',
        'class_roll',
        'board_roll',
        'registration_no',
        'shift',
        'image',
 
    ];

   public function enrollment(){
    return $this->hasMany(CourseEnrollment::class);
   }

   public function courses(){
    return $this->belongsToMany(Course::class,'course_enrollment','student_id','course_id')
    ->withPivot('teacher_id','id')
    ->withTimestamps();
   }
}
