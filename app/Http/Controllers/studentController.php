<?php

namespace App\Http\Controllers;


use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Auth::user()->student;
        return view("student.dashboard", compact("student"));

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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'session' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'class_roll' => 'required|string|max:255|unique:students',
            'board_roll' => 'required|string|max:255|unique:students',
            'registration_no' => 'required|string|max:255|unique:students',
            'shift' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

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
        $student = student::find($id);
        return view('admin.viewSingleStudent', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $students = student::find($id);
        if (Auth::user()->role !== 'admin' && $students->user->id != Auth::id()) {
            abort(403, 'unauthorized action !');
        }
        return view('student.edit', compact('students'));
    }

    public function viewSingleStudent(string $id)
    {
        $student = student::find($id);
        return view('student.viewSingleStudent', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $students = Student::findOrFail($id);
        if (Auth::user()->role !== 'admin' && $students->user->id != Auth::id()) {
            abort(403, 'unauthorized action !');
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'session' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'class_roll' => 'required|string|max:255|unique:students,class_roll,' . $id,
            'board_roll' => 'required|string|max:255|unique:students,board_roll,' . $id,
            'registration_no' => 'required|string|max:255|unique:students,registration_no,' . $id,
            'shift' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);



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
            if ($students ->$key != $value) {
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
        $student = student::findOrFail($id);
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
