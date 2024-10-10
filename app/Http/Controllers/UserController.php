<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Log;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::with('roles')->get(); // Fetch users with roles
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Exclude 'super-admin' role from being assignable
        $roles = Role::where('name', '!=', 'super-admin')->get();
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:8|confirmed',
            'roles'                 => 'required|string', // Single role as string
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Image validation
        ]);

        // Prevent assigning 'super-admin' role even if attempted via form manipulation
        if ($request->roles === 'super-admin') {
            return redirect()->back()->with('error', 'Assigning the super-admin role is not allowed.');
        }

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public'); // Store in 'public/profiles'
        } else {
            $imagePath = null;
        }

        // Create the user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'    => $request->roles,
            'password' => Hash::make($request->password),
            'image'    => $imagePath,
        ]);

        // Assign role to the user
        $user->assignRole($request->roles);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Exclude 'super-admin' role from being assignable
        $roles = Role::where('name', '!=', 'super-admin')->get();
        return view('backend.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Prevent editing of 'super-admin' user if desired (optional)
        // Example: if ($user->hasRole('super-admin')) { ... }

        // Validate the request data
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password'              => 'nullable|string|min:8|confirmed',
            'roles'                 => 'required|string', // Single role as string
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Image validation
        ]);

        // Prevent assigning 'super-admin' role even if attempted via form manipulation
        if ($request->roles === 'super-admin') {
            return redirect()->back()->with('error', 'Assigning the super-admin role is not allowed.');
        }

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            } elseif ($user->image) {
                \Log::warning("Attempted to delete non-existent image: {$user->image}");
            }

            $imagePath = $request->file('image')->store('profiles', 'public'); // Store in 'public/profiles'
        } else {
            $imagePath = $user->image; // Keep existing image
        }

        // Update user data
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'image'    => $imagePath,
        ]);

        // Sync role
        $user->syncRoles([$request->roles]); // Pass as array

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deletion of users with 'super-admin' role
        if ($user->hasRole('super-admin')) {
            return redirect()->route('users.index')->with('error', 'Super Admin users cannot be deleted.');
        }

        // Delete user's image if exists
        if ($user->image) {
            // Check if the file exists before attempting to delete
            if (Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            } else {
                \Log::warning("Attempted to delete non-existent image: {$user->image}");
            }
        }

        // Delete the user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
