<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests;
use App\Models\course;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\ElseIf_;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('course.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequests $request)
    {

        $validatedData =  $request->validated();
        course::create($validatedData);
        if (Auth::user()->role == 'admin') {
            return redirect()->route('course.list')->with('success', 'Course successfully added ');
        } else {
            return redirect()->route('teacher.dashboard')->with('success', 'add successfully ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $course = Course::findOrFail($id);
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'teacher') {
            abort(403, 'unauthorized action');
        }

        $teachers = User::where('role', 'teacher')->get();

        return view('course.edit', compact('course', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequests $request, string $id)
    {
        $course = Course::findOrFail($id);
        $validatedData =  $request->validated();
        $change = [];
        foreach ($validatedData as $key => $value) {
            if ($course->$key != $value) {
                $change[$key] = $value;
            }
        }
        if (!empty($change)) {
            $course->update($change);
            if (Auth::user()->role === 'admin') {
                return redirect()->route('course.list')->with('success', 'course data updated');
            } else {
                return redirect()->back()->with('success', 'course data updated');
            }
        } else {
            return redirect()->back()->with('info', 'no change detected');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $course = Course::findOrFail($id);
        if ($course->teacher_id != Auth::user()->id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }

        $course->delete();
        return redirect()->back()->with('success', 'successfully deleted ');
    }

    public function show_course(Request $request)
    {
        $search = $request->input('search');
        $course = course::query();

        try {
            $course = $course->where('course_name', 'like', "%{$search}%")
                ->orWhere("Course_code", "like", "%{$search}%")
                ->orWhere("course_fee", "like", "%{$search}%");
            $course = $course->paginate(10);
            $course->appends(['search' => $search]);
            return view('course.showAllCourse', compact('course', 'search'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'course not found' . $e->getMessage());
        }
    }
}
