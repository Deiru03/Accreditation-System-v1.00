<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->fill($request->validated());

        // Keep legacy 'name' in sync if name parts are provided
        $validated = $request->validated();
        $first = $validated['first_name'] ?? $user->first_name;
        $middle = $validated['middle_name'] ?? $user->middle_name;
        $last = $validated['last_name'] ?? $user->last_name;
        if ($first || $last) {
            $full = trim($first . ' ' . ($middle ? (substr($middle, 0, 1) . '. ') : '') . $last);
            if (!empty($full)) {
                $user->name = $full;
            }
        }

        if ($user->isDirty('email')) {
            // Force fill the email_verified_at to null if email is changed
            $user->forceFill([
                'email_verified_at' => null
            ]);
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

         /** @var \App\Models\User $user */
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
