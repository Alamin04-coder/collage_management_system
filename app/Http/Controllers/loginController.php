<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(LoginRequest $request)
    {
        // Authenticate user
        $request->authenticate();

        $user = Auth::user();

        // Role based redirect
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } else {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'msg' => 'User role not defined'
            ]);
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
