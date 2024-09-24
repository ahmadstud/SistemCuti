<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // <-- For password hashing
use App\Models\McApplication;
use App\Models\Announcement;

class OfficerController extends Controller
{
    public function index()
    {
        // Fetch all pending MC applications
        $applications = McApplication::where('status', 'pending')
        ->where('direct_admin_approval', false)  // Only fetch those not yet approved
        ->get();
        $announcements = Announcement::all(); // Adjust as necessary to fetch your announcements

        // Pass the applications data to the view
        return view('officer', compact('applications','announcements'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = McApplication::findOrFail($id);

        if ($request->status == 'approved_by_officer') {
            $application->officer_approved = true; // Set officer approval status to true
            $application->status = 'pending_admin'; // Set status to pending for admin approval
        } else {
            $application->status = 'rejected'; // Officer rejects
            $application->officer_approved = false; // Ensure officer approval status is false
        }
        $application->save();

        return redirect()->route('officer')->with('status', 'Application status updated successfully!');
    }

    public function updateOwnDetails3(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'ic' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // password confirmation validation
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ic = $request->ic;
        $user->phone_number = $request->phone_number;

        // Update password only if a new password is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save changes to the database
        $user->save();

        // Redirect with success message
        return redirect()->route('officer')->with('success', 'Your details have been updated successfully!');
    }
}
