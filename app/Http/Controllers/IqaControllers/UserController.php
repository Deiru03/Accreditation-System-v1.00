<?php
// filepath: c:\xampp\htdocs\clients-project\Accreditation-Web-v1\app\Http\Controllers\IqaControllers\UserController.php

namespace App\Http\Controllers\IqaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request): View
    {
        $query = User::query();

        // Search functionality - using actual database fields
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('first_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('employee_id', 'like', '%' . $searchTerm . '%')
                  ->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by user type - matching your database field
        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }

        // Filter by status - matching your database field
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('iqa-views.iUsers', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()//: View
    {
        // return view('iqa-views.user-create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'middle_name'  => 'nullable|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8|confirmed',
            'user_type'    => 'required|string|in:admin,iqa,validator,accreditor,uploader,user',
            'employee_id'  => 'nullable|string|max:255|unique:users,employee_id',
            'phone_number' => 'nullable|string|max:255',
            'address'      => 'nullable|string',
            'status'       => 'required|in:active,pending,inactive',
        ]);

        try {
            $fullname = $validated['first_name']
            . ' '
            . ($validated['middle_name'] ? $validated['middle_name'] . ' ' : '')
            . $validated['last_name'];

            $validated['name'] = $fullname;
            $validated['password'] = bcrypt($validated['password']);
            $validated['status'] = $validated['status'] ?? 'active';

            User::create($validated);

            return redirect()
            ->route('iqa.users.index')
            ->with('success', 'User created successfully!, Name: ' . $fullname);
        } catch (\Throwable $e) {
            \Log::error('User creation failed: ' . $e->getMessage(), [
            'exception' => $e,
            ]);

            return back()
            ->withInput()
            ->with('error', 'Failed to create user. Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): View
    {
        return view('components.iqa.user.show-form', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        return view('components.iqa.user.edit-form', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'email' => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) use ($user) {
                        // Check if the email exists in the database
                        $existingUser = User::where('email', $value)->first();
                        if ($existingUser && $existingUser->id !== $user->id) {
                            $fail('The email address is already associated with another user.');
                        }
                    },
                ],
                'user_type' => 'required|string|in:admin,iqa,validator,accreditor,uploader,user',
                'employee_id' => [
                    'nullable',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) use ($user) {
                        // Check if the employee ID exists in the database
                        $existingUser = User::where('employee_id', $value)->first();
                        if ($existingUser && $existingUser->id !== $user->id) {
                            $fail('The employee ID is already associated with another user.');
                        }
                    },
                ],
                'phone_number' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'status' => 'required|in:active,pending,inactive',
            ]);

            $userID = $user->id;

            Log::error("User update validation failed: " . json_encode($validated). " User ID: " . $userID);

            $user->update($validated);

            return redirect()->route('iqa.users.index')->with('success', 'User updated successfully! Name: ' . $user->first_name);
        } catch (\Throwable $th) {
            \Log::error('User update failed: ' . $th->getMessage(), [
                'exception' => $th,
            ]);

            return back()->withInput()->with('error', 'Failed to update user. Error: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): RedirectResponse
    {

        try {
            // Check if user is trying to delete themselves
            if ($user->id === Auth::id()) {
            return redirect()->route('iqa.users.index')
                ->with('error', 'You cannot delete your own account!');
            }

            $userName = $user->first_name . ' ' . $user->last_name;
            $userID = $user->id;

            // Perform the deletion
            $user->delete();

            return redirect()->route('iqa.users.index')
            ->with('success', 'User deleted successfully!'  . ' Name: ' . $userName . ' ID: ' . $userID);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('User deletion failed: ' . $e->getMessage());

            return redirect()->route('iqa.users.index')
            ->with('error', 'Failed to delete user. Please try again.' . ' Error: ' . $e->getMessage() );
        }
    }
}