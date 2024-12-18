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
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{

    public function storeMcApplication(Request $request)
    {
        // Validate the form input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'document_path' => 'nullable|mimes:pdf,jpg,png|max:2048', // Allow nullable file for non-MC types
            'reason' => 'required|string',
            'leave_type' => 'required|string',  // Adjusted validation
        ]);

        // Handle file upload conditionally
        $documentPath = null;
        if ($request->hasFile('document_path')) {
            $documentPath = $request->file('document_path')->store('mc_documents', 'public');
        }

        try {
            Log::info('Creating MC Application:', $request->all());  // Log request data

            McApplication::create([
                'user_id' => Auth::id(),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->reason,
                'document_path' => $documentPath,
                'status' => 'pending',
                'leave_type' => $request->leave_type, // Storing title directly
                'direct_admin_approval' => $request->input('direct_admin_approval', true),
            ]);

            return redirect()->back()->with('success', 'Permohonan Cuti telah dihantar!');
        } catch (\Exception $e) {
            Log::error('Error Creating MC Application:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Gagal menghantar permohonan Cuti. Sila cuba lagi.');
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
            'leave_type' => 'required|string', // Ensure leave_type matches note title
        ]);

        // Update MC application fields
        $mcApplication->start_date = $request->start_date;
        $mcApplication->end_date = $request->end_date;
        $mcApplication->reason = $request->reason;
        $mcApplication->leave_type = $request->leave_type; // Save the leave type

        // If selected_officer_id is passed, process it (if needed)
        if ($request->has('selected_officer_id')) {
            $officer = User::find($request->selected_officer_id);
            if ($officer) {
                // Store officer-related logic if necessary
            }
        }

        $mcApplication->direct_admin_approval = $request->input('direct_admin_approval') == '1';

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
        if ($mcApplication->save()) {
            return redirect()->back()->with('success', 'Permohonan Cuti telah dikemas kini!');
        } else {
            return redirect()->back()->with('error', 'Permohonan Cuti gagal dikemas kini!');
        }
    }


    public function dashboard(Request $request)
    {
        $today = now()->toDateString();
<<<<<<< HEAD

=======
    
>>>>>>> origin
        // Fetch list of staff on leave today, including their `total_mc_days`, joining with `users` table
        $staffOnLeaveToday = McApplication::with('user') // Assuming there's a 'user' relationship in McApplication model
            ->join('users', 'mc_applications.user_id', '=', 'users.id') // Join the users table
            ->where('mc_applications.start_date', '<=', $today)
            ->where('mc_applications.end_date', '>=', $today)
            ->where('mc_applications.status', 'approved') // Only approved leaves
            ->get();
<<<<<<< HEAD

        // Fetch announcements and notes as needed
        $announcements = Announcement::all();
        $notes = Note::all();

        // Get the current year and optionally use the year selected by the user
        $currentYear = now()->year;
        $year = $request->input('year', $currentYear); // Defaults to the current year if not specified

        // Generate a range of years for the dropdown, from 2020 to the next year
        $yearRange = range(2020, $currentYear + 1);

=======
    
        // Fetch announcements and notes as needed
        $announcements = Announcement::all();
        $notes = Note::all();
    
        // Get the current year and optionally use the year selected by the user
        $currentYear = now()->year;
        $year = $request->input('year', $currentYear); // Defaults to the current year if not specified
    
        // Generate a range of years for the dropdown, from 2020 to the next year
        $yearRange = range(2020, $currentYear + 1);
    
>>>>>>> origin
        // Query to get monthly data of staff on leave for the selected year
        $monthlyLeaveData = McApplication::select(
            DB::raw('MONTH(start_date) as month'),
            DB::raw('COUNT(*) as total_applications')
        )
        ->whereYear('start_date', $year) // Filter by the selected year
        ->where('status', 'approved') // Only count approved leaves
        ->groupBy(DB::raw('MONTH(start_date)'))
        ->orderBy(DB::raw('MONTH(start_date)')) // Order by month
        ->get();
<<<<<<< HEAD

        // Prepare an array with all 12 months, defaulting to 0 leave count for each month
        $leaveCountsByMonth = array_fill(1, 12, 0);

=======
    
        // Prepare an array with all 12 months, defaulting to 0 leave count for each month
        $leaveCountsByMonth = array_fill(1, 12, 0);
    
>>>>>>> origin
        // Populate the array with actual data from the query
        foreach ($monthlyLeaveData as $data) {
            $leaveCountsByMonth[$data->month] = $data->total_applications;
        }
<<<<<<< HEAD

        // Convert leave counts to JSON format for the chart (if required on the staff view)
        $leaveCountsByMonthJson = json_encode(array_values($leaveCountsByMonth));

=======
    
        // Convert leave counts to JSON format for the chart (if required on the staff view)
        $leaveCountsByMonthJson = json_encode(array_values($leaveCountsByMonth));
    
>>>>>>> origin
        // Pass the data to the staff dashboard view
        return view('staff', compact(
            'staffOnLeaveToday',
            'announcements',
            'leaveCountsByMonth',
            'leaveCountsByMonthJson',
            'year',
            'yearRange',
            'notes'
        ));
    }
    
    




    public function profile()
    {
        $notes = Note::all(); // Adjust as necessary to fetch notes
        return view('partials.staffside.profile',compact('notes'));
    }

    public function password()
    {
        $notes = Note::all(); // Adjust as necessary to fetch notes
        return view('partials.staffside.password',compact('notes'));
    }

    public function McApply(Request $request)
    {
        // Get the sort and order parameters from the request
        $sort = $request->input('sort', 'created_at'); // Default sorting by created_at
        $order = $request->input('order', 'asc'); // Default order is ascending

        // Fetch all MC applications for the logged-in user with sorting
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


        return view('partials.staffside.mc_apply', compact('mcApplications', 'selectedLeaveTypes','notes'));
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
