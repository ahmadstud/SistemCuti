<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- For accessing the authenticated user
use Illuminate\Support\Facades\Hash; // <-- For password hashing
use App\Models\User; // <-- Import the User model
use App\Models\McApplication;
use App\Models\Announcement;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{

    public function dashboard(Request $request) // Add Request parameter here
    {
        // Fetch total users excluding admins
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Handle search functionality
        $search = $request->get('search');
        $role = $request->get('role');

        // Fetch all users excluding admins with search functionality
        $users = User::where('role', '!=', 'admin')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($role, function ($query) use ($role) {
                return $query->where('role', $role);
            })
            ->get();

                // Fetch MC applications approved by officers and still pending admin approval
            $applications = McApplication::join('users', 'mc_applications.user_id', '=', 'users.id')
            ->select('mc_applications.*', 'users.name as user_name', 'users.role as user_role') // Get all fields from mc_applications and the user's name and role
            ->where('officer_approved', true)
            ->where('admin_approved', false) // Add this condition if you only want pending admin approvals
            ->get();

        // Fetch direct admin approval applications
        $directAdminApplications = McApplication::join('users', 'mc_applications.user_id', '=', 'users.id')
        ->select('mc_applications.*', 'users.name as user_name', 'users.role as user_role') // Get all fields from mc_applications and the user's name and role
            ->where('direct_admin_approval', true)
            ->where('admin_approved', false)  // Only fetch those not yet approved
            ->where('status', 'pending')  // Only fetch those not yet approved
            ->get();

        $officers = User::where('role', 'Penyelia')->get();
        $announcements = Announcement::all(); // Adjust as necessary to fetch your announcements
        $totalMcApplications = McApplication::count();
       // Fetch all MC applications with user names
       $allMcApplication = McApplication::join('users', 'mc_applications.user_id', '=', 'users.id')
       ->select('mc_applications.*', 'users.name as user_name', 'users.role as user_role') // Get all fields from mc_applications and the user's name and role
       ->get();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        return view('admin', compact('allMcApplication','directAdminApplications', 'totalUsers', 'users', 'applications', 'totalMcApplications', 'acceptedMcApplications', 'rejectedMcApplications', 'announcements', 'officers'));
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
            'role' => 'required|string',
            'job_status' => 'required|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'state' => 'nullable|string|max:255',
            'total_mc_days' => 'required|integer|min:0', // Validate mc_days input
        ]);

        // Update user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'ic' => $request->ic,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'job_status' => $request->job_status,
            'address' => $request->address,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'state' => $request->state,
            'total_mc_days' => $request->total_mc_days, // Ensure this matches the input name
            'selected_officer_id' => $request->selected_officer_id, // Add this line
        ]);

        // Redirect with success message
        return redirect()->route('admin')->with('success', 'User updated successfully!');
    }


    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $announcement->title = $request->title;
        $announcement->content = $request->content;

        if ($request->hasFile('image_path')) {
            // Delete old image if it exists
            if ($announcement->image_path && Storage::exists('public/' . $announcement->image_path)) {
                Storage::delete('public/' . $announcement->image_path);
            }

            // Store new image
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('public/announcements', $imageName);
            $announcement->image_path = 'announcements/' . $imageName; // Store the relative path
            $announcement->start_date = $request->start_date;  // Set the start date
            $announcement->end_date = $request->end_date;  // Set the end date
        }

        $announcement->save();

        return redirect()->route('admin')->with('success', 'Announcement updated successfully!');
    }

    // Method to delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Delete the user

        return redirect()->route('admin')->with('success', 'User deleted successfully!');
    }

    // Method to delete an announcement
    public function deleteAnnouncement($id)
    {
        // Find the announcement by ID or fail
        $announcement = Announcement::findOrFail($id);

        // Delete image if it exists
        if ($announcement->image && Storage::exists('public/announcements/' . $announcement->image)) {
            Storage::delete('public/announcements/' . $announcement->image);
        }

        // Delete the announcement
        $announcement->delete();

        // Redirect back with success message
        return redirect()->route('admin')->with('success', 'Announcement deleted successfully!');
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
            'job_status' => 'required|string',
            'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'postcode' => 'nullable|string|max:10',
        'state' => 'nullable|string|max:255',
        'mc_days' => 'required|integer|min:1', // Validate mc_days input
        'selected_officer_id' => 'nullable|exists:users,id', // Make this optional and validate if it exists
        ]);

        // Create the new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'ic' => $request->ic,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'job_status' => $request->job_status,
            'password' => bcrypt($request->password),  // Encrypt the password
            'total_mc_days' => $request->mc_days, // Set the mc_days input value
            'address' => $request->address,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'state' => $request->state,
            'selected_officer_id' => $request->selected_officer_id, // Add this line
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
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'state' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for profile image
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ic = $request->ic;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->postcode = $request->postcode;
        $user->state = $request->state;

        // Update password only if a new password is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
         // Handle profile image upload
         if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile_image'), $imageName);

            // Save the profile image path in the database
            $user->profile_image = 'storage/profile_image/' . $imageName;
        }

        // Save changes to the database
        $user->save();

        // Redirect with success message
        return redirect()->route('admin')->with('success', 'Your details have been updated successfully!');
    }


    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Store image if uploaded
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('announcements', 'public'); // Store in public/announcements
        }

        // Create announcement
        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
            'start_date' => $request->start_date ,
            'end_date' => $request->end_date ,
        ]);

        return redirect()->route('admin', ['section' => 'Annouce'])->with('success', 'Announcement created successfully.');
    }

}
