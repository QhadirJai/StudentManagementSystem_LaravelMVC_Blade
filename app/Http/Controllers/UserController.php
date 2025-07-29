<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Helper function to check admin role
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    // Display all lecturers (admin only)
    public function indexLecturer()
    {
        $this->authorizeAdmin();

        $lecturers = User::where('role', 'lecturer')->get();
        return view('admin.lecturers.index', compact('lecturers'));
    }

    // Show create lecturer form
    public function createLecturer()
    {
        $this->authorizeAdmin();
        return view('admin.lecturers.create');
    }

    // Store lecturer
    public function storeLecturer(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'lecturer',
        ]);

        return redirect()->route('admin.lecturers.index')->with('success', 'Lecturer created successfully!');
    }

    // Show edit lecturer form
    public function editLecturer(User $lecturer)
    {
        $this->authorizeAdmin();
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    // Update lecturer
    public function updateLecturer(Request $request, User $lecturer)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $lecturer->id,
        ]);

        $lecturer->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.lecturers.create')->with('success', 'Lecturer updated successfully!');
    }

    // Delete lecturer
    public function destroyLecturer(User $lecturer)
    {
        $this->authorizeAdmin();

        $lecturer->delete();

        return redirect()->route('admin.lecturers.index')->with('success', 'Lecturer deleted successfully!');
    }
}
