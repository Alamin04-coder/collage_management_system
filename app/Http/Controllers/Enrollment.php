<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class Enrollment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role === "student") {
            $student = Auth::user()->student;
            if(!empty($student && $student->id)){
            $courses = CourseEnrollment::where('student_id', $student->id)->get();
            return view('course.myCourse', compact('courses'));
            }
            return redirect()->route('student.info')->with('error','Your profile is not complete !');
        } elseif ($role === "teacher") {
            $teacher = Auth::user()->teacher;
            if (!empty($teacher && $teacher->id)) {
                $courses = Course::where('teacher_id', $teacher->id)->get();
                return view('course.myCourse', compact('courses'));
            }
            return redirect()->route('teacher.info')->with('error','Your profile is not complete !');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequests $request)
    {
        $validatedData = $request->validated();

        $enroll = CourseEnrollment::create($validatedData);
        $name = $enroll->course->course_name;
        return redirect()->route('course.list')->with('success',"successfully enrolled {$name}");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id);

        return view('course.index', compact('course'));
    }
    public function studentEnroll_course()
    {

        $student = Auth::user()->student;

        $course = $student->courses;
        $total = $course->count();
        return $total;
    }
}
