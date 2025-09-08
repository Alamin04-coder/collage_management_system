<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'name' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(4)],
        ]);

        if (Auth::check() && Auth::user()->role === 'admin') {
            $role = $request->role ?? 'student';
        } else {
            $role = str_contains($request->email, '@school.com') ? 'teacher' : 'student';
        }



        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        event(new Registered($user));

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            Auth::login($user);
        }
        session(['user_id' => $user->id]);
        if (Auth::user() && Auth::user()->role === 'admin') {
            return redirect()->route('users.list')->with('success', 'user create successfully !');
        } else {
            return redirect()->route('user.role');
        }
    }

    public function createUserByAdmin()
    {
        return view('user.createNewUser');
    }
}
