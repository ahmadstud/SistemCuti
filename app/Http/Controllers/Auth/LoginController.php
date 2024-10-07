<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model

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
                    return redirect()->route('admin');
                case 'officer':
                    return redirect()->route('officer');
                case 'staff':
                default:
                    return redirect()->route('staff');
            }
        }

        // If login attempt fails, redirect back with an error message
        return back()->withErrors(['username' => 'Invalid username or password']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
