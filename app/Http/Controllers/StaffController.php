<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\McApplication;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Note;
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
            'document_path' => 'nullable|mimes:pdf,jpg,png|max:2048', // Allow null for document_path
            'reason' => 'required|string',
            'direct_admin_approval' => 'nullable|boolean',
            'leave_type' => 'required|in:mc,annual,other',  // Ensure leave_type is one of the specified options
        ]);

        // Calculate the number of days for the MC application
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $daysRequested = $endDate->diffInDays($startDate) + 1; // Include both start and end dates

        // Check if user has enough leave days left for the selected leave type
        $user = Auth::user();
        if ($request->leave_type === 'mc' && $user->total_mc_days < $daysRequested) {
            return redirect()->back()->with('error', 'Hari MC tidak mencukupi!!');
        } elseif ($request->leave_type === 'annual' && $user->total_annual < $daysRequested) {
            return redirect()->back()->with('error', 'Cuti Tahunan tidak mencukupi!');
        } elseif ($request->leave_type === 'other' && $user->total_others < $daysRequested) {
            return redirect()->back()->with('error', 'Cuti lain-lain tidak mencukupi!');
        }

        // Initialize document path as null
        $documentPath = null;

        // Handle file upload if a document is provided
        if ($request->hasFile('document_path')) {
            $documentPath = $request->file('document_path')->store('mc_documents', 'public');
        }

        try {
            // Create the MC application
            McApplication::create([
                'user_id' => Auth::id(),  // Assign the currently authenticated user ID
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->reason,
                'document_path' => $documentPath, // This will be null if no document was uploaded
                'status' => 'pending',
                'leave_type' => $request->leave_type,  // Save the selected leave type
                'direct_admin_approval' => $request->input('direct_admin_approval') == '1',
                'officer_approved' => false,
            ]);

            // Deduct days based on leave type
            if ($request->leave_type === 'mc') {
                $user->total_mc_days -= $daysRequested;
            } elseif ($request->leave_type === 'annual') {
                $user->total_annual -= $daysRequested;
            } elseif ($request->leave_type === 'other') {
                $user->total_others -= $daysRequested;
            }

            // Save the updated user information
            $user->save();

            return redirect()->back()->with('success', 'Permohonan Cuti telah dihantar!');
        } catch (\Exception $e) {
            Log::error('Error Creating MC Application:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Gagal menghantar permohonan MC. Sila cuba lagi.');
        }
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
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'state' => 'nullable|string|max:255',
            'fullname' => 'nullable|string|max:255',
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
        $user->fullname = $request->fullname;

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
        return redirect()->back()->with('success', 'Maklumat diri anda telah dikemaskini!');
        return redirect()->back()->with('error', 'Maklumat diri anda gagak dikemaskini');
    }


    // Method to delete a user
    public function deleteMC($id)
    {
        $mcApplications = McApplication::findOrFail($id);
        $mcApplications->delete(); // Delete the user

        return redirect()->back()->with('success', 'Permohonan Cuti telah berjaya dihapuskan!');
        return redirect()->back()->with('error', 'Permohonan Cuti telah gagal dihapuskan!');
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
            'leave_type' => 'required|in:mc,annual,other', // Ensure leave_type is one of the specified options
        ]);

        // Calculate the number of days for the MC application
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $daysRequested = $endDate->diffInDays($startDate) + 1; // Include both start and end dates

        // Check if user has enough MC days left
        $user = Auth::user();
        if ($user->total_mc_days < $daysRequested) {
            return redirect()->back()->with('error', 'Hari MC tidak mencukupi!!');
        }

        // Update MC application fields
        $mcApplication->start_date = $request->start_date;
        $mcApplication->end_date = $request->end_date;
        $mcApplication->reason = $request->reason;
        $mcApplication->leave_type = $request->leave_type; // Save the leave type

        // Instead of selecting officer_id from this table, retrieve from users table
        if ($request->has('selected_officer_id')) {
            $officer = User::find($request->selected_officer_id);
            if ($officer) {
                // If officer exists, you might want to store something or process it
                // However, you're not updating mcApplication with selected_officer_id
            }
        }

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

        return redirect()->back()->with('success', 'Permohonan Cuti telah dikemas kini!');
        return redirect()->back()->with('error', 'Permohonan Cuti gagal dikemas kini!');
    }

    public function dashboard()
    {
        // Get today's date
        $today = now()->toDateString();
        // Get the list of staff on MC today along with their total_mc_days from users table
        $staffOnLeaveToday = McApplication::with('user') // Assuming there's a 'user' relationship in McApplication model
        ->join('users', 'mc_applications.user_id', '=', 'users.id') // Join the users table
        ->where('mc_applications.start_date', '<=', $today)
        ->where('mc_applications.end_date', '>=', $today)
        ->where('mc_applications.status', 'approved') // Assuming you have a status column to check for approval
        ->select('mc_applications.*', 'users.total_mc_days', 'users.total_annual', 'users.total_others') // Select fields from both tables
        ->get();

        $announcements = Announcement::all(); // Adjust as necessary to fetch your announcements
        $officers = User::where('role', 'officer')->get(); // Fetch officers
         // Fetch total users excluding admins
         $totalUsers = User::all();
         $notes = Note::all(); // Adjust as necessary to fetch your notes
        return view('staff',compact('announcements','staffOnLeaveToday','totalUsers','officers', 'notes',));
    }

    public function profile()
    {
        return view('partials.staffside.profile');
    }

    public function password()
    {
        return view('partials.staffside.password');
    }

    public function McApply()
    {
         // Fetch all MC applications for the logged-in user
         $mcApplications = McApplication::where('user_id', Auth::id())->get();
       return view('partials.staffside.mc_apply', compact('mcApplications'));
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Validate the password input data
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // New password must be confirmed
        ]);

        // Update the user's password
        $user->password = Hash::make($request->password); // Hash the new password

        // Save changes to the database
        $user->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Kata laluan anda telah berjaya dikemas kini!');
        return redirect()->back()->with('error', 'Kata laluan anda telah gagal dikemas kini!');
    }


}
