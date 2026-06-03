<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'department' => 'required|string|max:50',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.confirmed' => 'Passwords do not match',
            'email.unique' => 'This email is already registered',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'department' => $validated['department'],
            'password' => Hash::make($validated['password']),
            'role' => 'Admin',
            'status' => 'Active',
        ]);

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }
}
