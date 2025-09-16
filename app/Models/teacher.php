<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  protected $fillable = [
    'user_id',
    'name',
    'department',
    'specialization',
    'phone',
    'image',
    'teacher_id',
    'dob',
    'join_date',
    'address',
    'gender',
  ];

  public function enrollment()
  {
    return $this->hasMany(CourseEnrollment::class);
  }
  public function courses()
  {
    return $this->belongsToMany(course::class, 'course_enrollment', 'teacher_id', 'course_id')
      ->withPivot('student_id', 'id')
      ->timestamps();
  }
  public function course()
  {
    return $this->hasMany(Course::class, 'teacher_id');
  }
}
