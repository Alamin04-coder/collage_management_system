<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests;
use App\Models\Notice;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class teacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $notices = Notice::latest()->take(2)->get();
        return view("teachers.dashboard", compact("teacher","notices"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("teachers.info");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequests $request)
    {


        $validatedData = $request->validated();

        if (Auth::user()->role !== "admin") {
            if (teacher::where('user_id', Auth::id())->exists()) {
                return redirect()->back()->with('error', 'you already added your information');
            }
        }
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('teacher_images'), $imageName);
        }

        $validatedData['user_id'] = Auth::id();
        $validatedData['image'] = $imageName;
        $teacher = Teacher::create($validatedData);
        if (Auth::user()->role == 'admin') {
            return redirect()->route('teacher.list')->with('success', 'Teacher information added successfully.');
        }
        return redirect()->route('teacher.dashboard')->with('success', 'Teacher information saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::find($id);
        return view('teachers.viewSingleTeacher', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::find($id);
        if (Auth::user()->role !== 'admin' && $teacher->user->id != Auth::id()) {
            abort(403, 'unauthorized action !');
        }
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequests $request, string $id)
    {
        $teacher = teacher::find($id);

        if (Auth::user()->role !== 'admin' && $teacher->user->id != Auth::id()) {
            abort(403, 'unauthorized action !');
        }
        $validatedData = $request->validated();
        $imageName = $teacher->image;
        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('teacher_images/' . $imageName))) {
                unlink(public_path('teacher_images/' . $imageName));
            }
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('teacher_images'), $imageName);
        }
        $validatedData['image'] = $imageName;

        $change = [];
        foreach ($validatedData as $key => $value) {
            if ($teacher->$key != $value) {
                $change[$key] = $value;
            }
        }
        if (!empty($change)) {
            $teacher->update($change);
            if (Auth::user()->role === 'admin') {
                return  redirect()->route('teacher.list')->with('success', 'Teacher information updated successfully.');
            } else {
                return  redirect()->route('teacher.update.profile')->with('success', 'Teacher information updated successfully.');
            }
            return redirect()->route('teacher.list')->with('info', 'No change detected');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        try {
            if ($teacher->image && file_exists(public_path('teacher/images' . $teacher->image))) {
                unlink(public_path('teacher/images' . $teacher->image));
            }
            $teacher->delete();
            return redirect()->back()->with('success', 'teacher information deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update_p(Request $request)
    {
        $teacher = Auth::user()->teacher;
        return view('teachers.profile', compact('teacher'));
    }
}
