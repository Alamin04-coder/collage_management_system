<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use function Laravel\Prompts\password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if($user->id != Auth::id()){
            abort(403,"Unauthorized action");

        }
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::min(4), 'confirmed'],
        ]);

        if(Hash::check($validated['password'],$user->password)){
            return redirect()->back()->with('error',"Old password and new password can't be same");
        }
       

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'password-updated');
    }
}
