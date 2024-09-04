<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request) : RedirectResponse
    {
        $messages = [
            'required' => 'The :attribute field is required.',
            'current_password.current_password' => 'The provided current password is incorrect.',
            'confirmed' => 'The :attribute confirmation does not match.',
            'min' => 'The :attribute must be at least :min characters long.',
        ];

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], $messages);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        alert()->success('Success', 'Your password has been successfully updated.');
        return back();
    }
}
