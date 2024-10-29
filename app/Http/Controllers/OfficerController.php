<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // <-- For password hashing
use App\Models\McApplication;
use App\Models\Announcement;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $application = McApplication::findOrFail($id);

        if ($request->status == 'approved_by_officer') {
            $application->officer_approved = true; // Set officer approval status to true
            $application->status = 'pending_admin'; // Set status to pending for admin approval
            $application->rejection_reason = null; // Ensure rejection reason is null if approved
        } else {
            $application->status = 'rejected'; // Officer rejects
            $application->officer_approved = false; // Ensure officer approval status is false
            $application->rejection_reason = $request->input('rejection_reason'); // Save the rejection reason
        }

        $application->save();

        return redirect()->back()->with('success', 'Status permohonan telah dikemas kini!');
        return redirect()->back()->with('error', 'Status permohonan gagal dikemas kini!');
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
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'state' => 'nullable|string|max:255',
            'fullname' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate profile image
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
        return redirect()->back()->with('success', 'Maklumat anda telah dikemas kini!');
        return redirect()->back()->with('error', 'Maklumat anda gagal dikemas kini!');
    }

    // In your storeMcApplication method
public function storeMcApplication(Request $request)
{
    // Validate the form input
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'document_path' => 'nullable|mimes:pdf,jpg,png|max:2048', // Allow nullable file for non-MC types
        'reason' => 'required|string',
        'leave_type' => 'required|string',  // Change to title validation
    ]);

    // Handle file upload conditionally
    $documentPath = null;
    if ($request->hasFile('document_path')) {
        $documentPath = $request->file('document_path')->store('mc_documents', 'public');
    }

    try {
        McApplication::create([
            'user_id' => Auth::id(),  // Assign the currently authenticated user ID
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'document_path' => $documentPath, // Save document path if available
            'status' => 'pending',
            'leave_type' => $request->leave_type, // Store the title directly
            'direct_admin_approval' => $request->input('direct_admin_approval', true), // Change to dynamic
        ]);

        return redirect()->back()->with('success', 'Permohonan Cuti telah dihantar!');
    } catch (\Exception $e) {
        Log::error('Error Creating MC Application:', ['message' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Gagal menghantar permohonan Cuti. Sila cuba lagi.');
    }
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
            'leave_type' => 'required|string|exists:notes,title', // Ensure leave_type matches note title
        ]);

        // Update MC application fields
        $mcApplication->start_date = $request->start_date;
        $mcApplication->end_date = $request->end_date;
        $mcApplication->reason = $request->reason;
        $mcApplication->leave_type = $request->leave_type; // Update leave_type

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
        return redirect()->back()->with('error', 'Permohonan Cuti telah dikemas kini!');
    }

    public function deleteMC($id)
    {
        // Retrieve the MC application by its ID
        $mcApplication = McApplication::findOrFail($id);

        // Delete the MC application
        $mcApplication->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Permohonan Cuti telah berjaya dihapuskan!');
        return redirect()->back()->with('error', 'Permohonan Cuti telah gagal dihapuskan!');
    }

    public function profile()
    {
        $notes = Note::all();
        return view('partials.officerside.profile',compact('notes'));
    }

    public function password()
    {
        $notes = Note::all();
        return view('partials.officerside.password',compact('notes'));
    }

    public function McApprove(Request $request)
    {
        // Get the currently authenticated officer
        $officer = Auth::user();
        $sort = $request->input('sort', 'created_at'); // Default sorting by created_at
         $order = $request->input('order', 'asc'); // Default order is ascending
        // Fetch all pending MC applications with user names, filtered by selected officer and direct admin approval status
        $applications = McApplication::where('mc_applications.status', 'pending')
            ->where('mc_applications.direct_admin_approval', false) // Only fetch those not yet approved by admin
            ->whereHas('user', function ($query) use ($officer) {
                // Filter where the selected officer for the staff is the logged-in officer
                $query->where('selected_officer_id', $officer->id);
            })
            ->join('users', 'mc_applications.user_id', '=', 'users.id') // Join with users table
            ->select('mc_applications.*', 'users.name as user_name') // Select necessary fields
            ->orderBy($sort, $order)
            ->paginate(10);

        // Fetch all notes
        $notes = Note::all();

        // Create an array to hold selected leave types
        $selectedLeaveTypes = [];

        foreach ($applications as $application) {
            // Find the note where the title matches the leave_type (assuming leave_type is stored as a title in your notes)
            $note = $notes->firstWhere('title', $application->leave_type);

            // Check if note exists and store the title of the selected leave type
            if ($note) {
                $selectedLeaveTypes[$application->id] = $note->title;
            } else {
                $selectedLeaveTypes[$application->id] = 'Tidak ada catatan dipilih';
            }
        }

        // Pass applications and selectedLeaveTypes to the view
        return view('partials.officerside.mc_approve', compact('applications', 'selectedLeaveTypes','notes'));
    }


    public function McApply(Request $request)
    {
    $sort = $request->input('sort', 'created_at'); // Default sorting by created_at
    $order = $request->input('order', 'asc'); // Default order is ascending
    // Fetch all MC applications for the logged-in user
     $mcApplications = McApplication::where('user_id', Auth::id())
     ->orderBy($sort, $order)
     ->paginate(10);
     $notes = Note::all(); // Fetch all notes

     // Create an array to hold selected leave types
     $selectedLeaveTypes = [];

     foreach ($mcApplications as $application) {
         // Find the note where the title matches the leave_type
         $note = $notes->firstWhere('title', $application->leave_type);
         if ($note) {
             // Store the title of the selected leave type
             $selectedLeaveTypes[$application->id] = $note->title;
         } else {
             $selectedLeaveTypes[$application->id] = 'Tidak ada catatan dipilih';
         }
     }
        return view('partials.officerside.mc_apply', compact('mcApplications','selectedLeaveTypes','notes'));
    }
    public function dashboard(Request $request)
    {
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
     // Notes
     $notes = Note::all(); // Adjust as necessary to fetch your notes
      // Get the current year and optionally the user-selected year
      $currentYear = now()->year;
      $year = $request->input('year', $currentYear); // Default to current year

      // Generate a range of years, e.g., from 2020 to the current year + 1 (can adjust starting year as needed)
      $yearRange = range(2020, $currentYear + 1);

      // Query to get the monthly data of staff on leave (cuti) for the selected year
      $monthlyLeaveData = McApplication::select(
          DB::raw('MONTH(start_date) as month'),
          DB::raw('COUNT(DISTINCT user_id) as total_staff')
      )
      ->whereYear('start_date', $year) // Use the selected year
      ->where('status', 'approved') // Only count approved leaves
      ->groupBy(DB::raw('MONTH(start_date)'))
      ->orderBy(DB::raw('MONTH(start_date)')) // Ensure data is ordered by month
      ->get();

      // Prepare an array with all 12 months and set default values as 0
      $leaveCountsByMonth = array_fill(1, 12, 0);

      // Fill the actual values from the query into the leave counts
      foreach ($monthlyLeaveData as $data) {
          $leaveCountsByMonth[$data->month] = $data->total_staff;
      }
      $notes = Note::all();
        return view('officer', compact('staffOnLeaveToday','announcements','leaveCountsByMonth','year','yearRange','notes'));
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
