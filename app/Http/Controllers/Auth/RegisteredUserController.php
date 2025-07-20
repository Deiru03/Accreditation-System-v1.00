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
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard', absolute: false));
    // }

        public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'employee_id' => ['required', 'string', 'max:50', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'user_type' => ['required', 'in:iqa,validator,accreditor,uploader'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create full name for the existing 'name' field (for compatibility)
        $fullName = $request->first_name;
        if ($request->middle_name) {
            $fullName .= ' ' . $request->middle_name;
        }
        $fullName .= ' ' . $request->last_name;

        $user = User::create([
            'name' => $fullName, // For compatibility with existing system
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'employee_id' => $request->employee_id,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
            'status' => 'pending', // All new users start as pending
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect to dashboard with pending message
        return redirect(route('dashboard', absolute: false))
            ->with('info', 'Your account has been created and is pending approval from IQA.');
    }
}
