<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests;
use App\Models\course;
use App\Models\CourseEnrollment;
use App\Models\student;
use Illuminate\Support\Facades\Auth;

class Enrollment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.mycourse');
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

       CourseEnrollment::create($validatedData);
        return redirect()->route('course.list');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id);

        return view('course.index',compact('course'));
    }
    public function studentEnroll_course(){

        $student = Auth::user()->student;

        $course = $student->courses;
        $total = $course->count();
        return $total;



        

    }

}