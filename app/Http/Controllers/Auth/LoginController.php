<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash; // Import Hash for password hashing
use Illuminate\Support\Facades\Validator; // Import Validator for validation

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Attempt to log the user in using the name and password
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password], $request->remember)) {
            $user = Auth::user();
    
            // Redirect based on user role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin')->with('success', 'Log Masuk Berjaya');
                case 'officer':
                    return redirect()->route('officer')->with('success', 'Log Masuk Berjaya');
                case 'staff':
                default:
                    return redirect()->route('staff')->with('success', 'Log Masuk Berjaya');
            }
        }
    
        // If login attempt fails, redirect back with an error message
        return back()->withErrors(['username' => 'Nama pengguna atau kata laluan tidak sah'])->with('error', 'Gagal Log Masuk');
    }
    
    



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Handle the password reset request
    public function resetPassword(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:8|confirmed', // Ensure you have 'new_password_confirmation' field in the form
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // Update the user's password
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Kata laluan anda telah ditukar!');
        }

        return back()->withErrors(['email' => 'Emel tidak ditemukan.']);
    }
}
