<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\student;
use App\Models\teacher;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        $totalStudent = student::count();
        $totalTeacher = teacher::count();
        $totalUser = User::count();
        $totalCourse = course::count();

        return view("admin.dashboard", compact('totalStudent', 'totalTeacher', 'totalUser','totalCourse'));
    }
    // Show all students with search and pagination
    public function show_student(Request $request)
    {
        $search = $request->input('search');
        $students = student::query();
        try {
            if ($search) {
                $students->where('name', 'like', "%{$search}%")
                    ->orWhere('class_roll', 'like', "%{$search}%")
                    ->orWhere('board_roll', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('session', 'like', "%{$search}%")
                    ->orWhere('shift', 'like', "%{$search}%")
                    ->orWhere('registration_no', 'like', "%{$search}%");
            }
            $students = $students->paginate(10);
            $students->appends(['search' => $search]);
            return view("admin.viewStudent", compact('students', 'search'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching student data: ' . $e->getMessage());
        }
    }

    public function show_teacher(Request $request)
    {
        $search = $request->input('search');
        $teachers = teacher::query(); // student::query() → teacher::query()
        try {
            if ($search) {
                $teachers->where('name', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('teacher_id', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%");
            }
            $teachers = $teachers->paginate(10);
            $teachers->appends(['search' => $search]);
            return view("admin.teacherView", compact('teachers', 'search'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching teacher data: ' . $e->getMessage());
        }
    }

    public function show_user(Request $request)
    {
        $search = $request->input('search');
        $users = User::query();

        try {
            if ($search) {
                $users->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            }
            $users = $users->paginate(10);
            $users->appends(['search' => $search]);
            return view('user.test', compact('users', 'search'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'users not found !' . $e->getMessage());
        }
    }

    public function edit_user(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->role !== 'admin' && $user->id != Auth::id()) {
            abort(403, 'Unauthorized action!');
        }
        return view('user.edit', compact('user'));
    }


    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->role !== 'admin' && $user->id != Auth::id()) {
            abort(403, 'Unauthorized action ');
        }

        $roles = [
            'name' => 'required|max:16|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ];

        if (Auth::user()->role === 'admin') {
            $roles['role'] = 'required|string|in:admin,teacher,student';
        }

        if ($user->id === Auth::id()) {
            $roles['current_password'] = ['required', 'current_password'];
        }

        if ($request->filled('password')) {
            $roles['password'] = ['required', Password::min(4), 'confirmed'];
        }

        $validatedData = $request->validate($roles);
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        if (Auth::user()->role !== 'admin') {
            unset($validatedData['role']);
        }
        $change = [];
        foreach ($validatedData as $key => $value) {
            if (trim((string)$user->$key) !== trim((string)$value)) {
                $change[$key] = $value;
            }
        }

        $userRole = Auth::user()->role;
        if (!empty($change)) {
            $user->update($change);
            if ($userRole === 'admin') {
                return redirect()->route('users.list')->with('success', 'user data updated successfully');
            } elseif ($userRole === 'teacher') {
                return redirect()->route('teacher.update.profile')->with('success', ' successfully updated your account');
            } else {
                return redirect()->route('student.dashboard')->with('success', ' successfully updated your account');
            }
        }
        return redirect()->back()->with('info', 'no change detected');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if(Auth::user()->role !== 'admin' && Auth::user()->id !== $user->id) {
            abort(403,'unauthorized action');
        }
        $user->delete();

        return redirect()->back()->with('success', 'User delete success fully ');
    }

    public function role()
    {
        return view('auth.choiceRole');
    }
}
