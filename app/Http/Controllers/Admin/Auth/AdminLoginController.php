<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AdminLoginController extends Controller
{

    public function login_form() {
        return view('admin.login');
    }

    public function adminLogin(Request $request) {
        $request->validate([
            'email' => 'email|required',
            'password'=> 'string|required',
        ]);

        $loginData = $request->only('email','password');
        if(Auth::attempt($loginData,$request->filled('remember'))){
            $request->session()->regenerate();

            if(Auth::user()->role !== "admin"){
                Auth::logout();
                return redirect()->back()->with('error','only admin can login here !');
            }
            return redirect()->intended(route('admin.dashboard'))->with('success','Login success');
        }
        return back()->with('error','invalid input');
        
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form');
        
    }
}
