<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests;
use App\Models\Notice;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::user()->student;
        $notices = Notice::latest()->take(2)->get();
        $allNotice = Notice::latest()->get();
        return view("student.dashboard", compact("student","notices","allNotice"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.info');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequests $request)
    {

        $validatedData = $request->validated();

        if (Auth::user()->role !== "admin") {
            if (Student::where('user_id', Auth::id())->exists()) {
                return redirect()->back()->with('error', 'you already added your information');
            }
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('student_images'), $imageName);
        }
        $validatedData['user_id'] = Auth::id();
        $validatedData['image'] = $imageName;
        Student::create($validatedData);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.student.list')->with('success', 'Student information added successfully.');
        }

        return  redirect()->route('student.dashboard')->with('success', 'Student information saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        return view('admin.viewSingleStudent', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $students = Student::find($id);
        if (Auth::user()->role !== 'admin' && $students->user->id != Auth::id()) {
            abort(403, 'unauthorized action !');
        }
        return view('student.edit', compact('students'));
    }

    public function viewSingleStudent(string $id)
    {
        $student = Student::find($id);
        return view('student.viewSingleStudent', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequests $request, string $id)
    {

        $students = Student::findOrFail($id);
        if (Auth::user()->role !== 'admin' && $students->user->id != Auth::id()) {
            abort(403, 'unauthorized action !');
        }
        $validatedData = $request->validated();



        $imageName = $students->image;
        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('student_images/' . $imageName))) {
                unlink(public_path('student_images/' . $imageName));
            }
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('student_images'), $imageName);
        }
        $validatedData['image'] = $imageName;
        $changes = [];
        foreach ($validatedData as $key => $value) {
            if ($students->$key != $value) {
                $changes[$key] = $value;
            }
        }



        if (!empty($changes)) {
            $students->update($changes);
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.student.list')->with('success', 'student information update successfully .');
            }
            return redirect()->route('update.profile')->with('success', 'student information update successfully .');
        }
        return redirect()->back()->with('info', 'no change detected');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        try {
            if ($student->image && file_exists(public_path('student_images/' . $student->image))) {
                unlink(public_path('student_images/' . $student->image));
            }
            $student->delete();
            return redirect()->route('admin.students')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.student.list')->with('error', 'Failed to delete student. Please try again.');
        }
    }



    public function update_p()
    {

        $student = Auth::user()->student;
        return view("student.profile", compact("student"));
    }
}
