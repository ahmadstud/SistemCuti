<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- For accessing the authenticated user
use Illuminate\Support\Facades\Hash; // <-- For password hashing
use App\Models\User; // <-- Import the User model
use App\Models\McApplication;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;



class AdminController extends Controller
{

    public function dashboard()
    {
        // Fetch total users excluding admins
        $totalUsers = User::where('role', '!=', 'admin')->count();
        // Fetch all users excluding admins
        $users = User::where('role', '!=', 'admin')->get();
            // Fetch MC applications approved by officers and still pending admin approval
            $applications = McApplication::where('officer_approved', true)
            ->get();

            // Fetch direct admin approval applications
        $directAdminApplications = McApplication::where('direct_admin_approval', true)
        ->where('admin_approved', false)  // Only fetch those not yet approved
        ->where('status', 'pending')  // Only fetch those not yet approved
        ->get();


        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        return view('admin', compact('directAdminApplications','totalUsers', 'users', 'applications', 'totalMcApplications', 'acceptedMcApplications', 'rejectedMcApplications'));
    }

    // Method to show the edit form
    public function editUser($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        return view('editUser', compact('user')); // Return view with user data
    }

    // Method to update user information
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'ic' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'role' => 'required|string'
        ]);

        // Update user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'ic' => $request->ic,
            'phone_number' => $request->phone_number,
            'role' => $request->role
        ]);

        return redirect()->route('admin')->with('success', 'User updated successfully!');
    }

    // Method to delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Delete the user

        return redirect()->route('admin')->with('success', 'User deleted successfully!');
    }

    public function storeUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'ic' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'role' => 'required|string',
        ]);

        // Create the new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'ic' => $request->ic,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'password' => bcrypt($request->password),  // Encrypt the password
            'total_mc_days' => 0,  // Default value if applicable
        ]);

        // Redirect back to admin with a success message
        return redirect()->route('admin')->with('success', 'New Staff/Officer added successfully!');
    }


    public function approve($id)
    {
        $application = McApplication::find($id);

        if (!$application) {
            return redirect()->back()->with('error', 'Application not found.');
        }

        // Check if it's direct admin approval or needs officer approval
        if (!$application->direct_admin_approval && !$application->officer_approved) {
            return redirect()->back()->with('error', 'MC must be approved by an officer first.');
        }

        $startDate = Carbon::parse($application->start_date);
        $endDate = Carbon::parse($application->end_date);

        // Calculate the number of days manually
        $daysRequested = ($endDate->timestamp - $startDate->timestamp) / (60 * 60 * 24) + 1; // Convert seconds to days and add 1

        // Ensure at least 1 day is requested
        $daysRequested = max(1, (int) $daysRequested);

        // Find the user who submitted the application
        $user = User::find($application->user_id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Deduct the requested days from the user's total MC days
        $user->total_mc_days -= $daysRequested;
        $user->save();

        // Update the application's status to approved
        $application->admin_approved = true;
        $application->status = 'approved';
        $application->save();

        return redirect()->back()->with('success', 'MC application approved by admin.');
    }

    public function reject($id)
    {
        $application = McApplication::find($id);

        if (!$application) {
            return redirect()->back()->with('error', 'Application not found.');
        }

        // Optionally, you can check if the application can be rejected
        // For example, check if it has already been approved
        if ($application->status === 'approved') {
            return redirect()->back()->with('error', 'Cannot reject an already approved application.');
        }

        // Update the application's status to rejected
        $application->status = 'rejected';
        $application->admin_approved = false; // Optionally set this to false
        $application->save();

        return redirect()->back()->with('success', 'MC application rejected by admin.');
    }

    public function updateOwnDetails(Request $request)
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
        return redirect()->route('admin')->with('success', 'Your details have been updated successfully!');
    }

}
