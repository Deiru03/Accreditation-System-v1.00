<?php
// filepath: c:\xampp\htdocs\clients-project\Accreditation-Web-v1\app\Http\Controllers\IqaControllers\UserController.php

namespace App\Http\Controllers\IqaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
    public function create(): View
    {
        return view('iqa-views.user-create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|string|in:admin,iqa,validator,accreditor,uploader,user',
            'employee_id' => 'nullable|string|max:255|unique:users,employee_id',
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,pending,inactive',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['status'] = $validated['status'] ?? 'active';

        User::create($validated);

        return redirect()->route('iqa.users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): View
    {
        return view('iqa-views.user-show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        return view('iqa-views.user-edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'user_type' => 'required|string|in:admin,iqa,validator,accreditor,uploader,user',
            'employee_id' => 'nullable|string|max:255|unique:users,employee_id,' . $user->id,
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,pending,inactive',
        ]);

        $user->update($validated);

        return redirect()->route('iqa.users.index')->with('success', 'User updated successfully!');
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

            // Perform the deletion
            $user->delete();

            return redirect()->route('iqa.users.index')
            ->with('success', 'User deleted successfully!');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('User deletion failed: ' . $e->getMessage());

            return redirect()->route('iqa.users.index')
            ->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
