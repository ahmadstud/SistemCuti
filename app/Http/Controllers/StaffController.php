<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\McApplication;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash; // <-- For password hashing
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function storeMcApplication(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'document_path' => 'required|mimes:pdf,jpg,png|max:2048',
            'reason' => 'required|string',
            'leave_type' => 'required|in:sick,annual', // Validate leave type
            'direct_admin_approval' => 'nullable|boolean',
        ]);

        // Calculate the number of days for the MC application
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $daysRequested = $endDate->diffInDays($startDate) + 1; // Include both start and end dates

        // Check if user has enough MC days left
        $user = Auth::user();
        if ($user->total_mc_days < $daysRequested) {
            return redirect()->back()->with('error', 'Insufficient MC days available!');
        }

        // Handle file upload
        $documentPath = $request->file('document_path')->store('mc_documents', 'public');

        try {
            McApplication::create([
                'user_id' => Auth::id(),  // Assign the currently authenticated user ID
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->reason,
                'document_path' => $documentPath,
                'status' => 'pending',
                'direct_admin_approval' => $request->input('direct_admin_approval') == '1' ? true : false,
                'officer_approved' => false,
                'leave_type' => $validatedData['leave_type'],
            ]);

            return redirect()->back()->with('success', 'MC application submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Error Creating MC Application:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to submit MC application. Please try again.');
        }
    }


    public function index()
    {
        // Fetch all MC applications for the logged-in user
        $mcApplications = McApplication::where('user_id', Auth::id())->get();
        $officers = User::where('role', 'officer')->get(); // Fetch officers
        $announcements = Announcement::all(); // Adjust as necessary to fetch your announcements
        return view('staff', compact('mcApplications', 'officers','announcements'));
    }


    public function updateOwnDetails2(Request $request)
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
        $user->postcode = $request->postcode;
        $user->state = $request->state;
        $user->city = $request->city;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/profile_image'), $imageName);

            // Save the profile image path in the database
            $user->profile_image = 'storage/profile_image/' . $imageName;
        }

        // Update password only if a new password is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save changes to the database
        $user->save();

        // Redirect with success message
        return redirect()->route('staff')->with('success', 'Your details have been updated successfully!');
    }



    // Method to delete a user
    public function deleteMC($id)
    {
        $mcApplications = McApplication::findOrFail($id);
        $mcApplications->delete(); // Delete the user

        return redirect()->route('staff')->with('success', 'MC Application deleted !');
    }


    public function editMC(Request $request, $id)
{
    // Retrieve the existing MC application
    $mcApplication = McApplication::findOrFail($id);

    // Validate the form input
    $validatedData = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'document_path' => 'nullable|mimes:pdf,jpg,png|max:2048', // Make this optional
        'reason' => 'required|string',
        'direct_admin_approval' => 'nullable|boolean',
    ]);

    // Calculate the number of days for the MC application
    $startDate = Carbon::parse($request->start_date);
    $endDate = Carbon::parse($request->end_date);
    $daysRequested = $endDate->diffInDays($startDate) + 1; // Include both start and end dates

    // Check if user has enough MC days left
    $user = Auth::user();
    if ($user->total_mc_days < $daysRequested) {
        return redirect()->back()->with('error', 'Insufficient MC days available!');
    }

    // Update MC application fields
    $mcApplication->start_date = $request->start_date;
    $mcApplication->end_date = $request->end_date;
    $mcApplication->reason = $request->reason;
    $mcApplication->direct_admin_approval = $request->input('direct_admin_approval') == '1' ? true : false;

    // Handle file upload if a new document is provided
    if ($request->hasFile('document_path')) {
        // Delete old document if it exists
        if ($mcApplication->document_path) {
            Storage::disk('public')->delete($mcApplication->document_path);
        }
        // Store new document
        $documentPath = $request->file('document_path')->store('mc_documents', 'public');
        $mcApplication->document_path = $documentPath;
    }

    // Save changes to the database
    $mcApplication->save();

    return redirect()->back()->with('success', 'MC application updated successfully!');
}



}
