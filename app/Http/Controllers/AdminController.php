<?php
namespace App\Http\Controllers;
use App\Models\Announcement;
use App\Models\McApplication;
use App\Models\Note;
use App\Models\Staff;
use App\Models\User; // <-- Import the User model
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; // <-- For accessing the authenticated user
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // <-- For password hashing
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{

//UTAMA
    public function dashboard(Request $request)
    {
        // Get the current year and optionally the user-selected year
        $currentYear = now()->year;
        $year = $request->input('year', $currentYear); // Default to current year

        // Generate a range of years, e.g., from 2020 to the current year + 1 (can adjust starting year as needed)
        $yearRange = range(2020, $currentYear + 1);

        // Fetch total users excluding admins
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Fetch all users excluding admins
        $usersQuery = User::where('role', '!=', 'admin');

        // Get filter inputs from the request
        $statusFilter = $request->input('status');
        $startDateFilter = $request->input('start_date');
        $endDateFilter = $request->input('end_date');
        $roleFilter = $request->input('role'); // Get role filter input
        $jobStatusFilter = $request->input('job_status'); // Get job status filter input

        // Apply filters to the users query
        if ($roleFilter) {
            $usersQuery->where('role', $roleFilter);
        }
        if ($jobStatusFilter) {
            $usersQuery->where('job_status', $jobStatusFilter);
        }
        $users = $usersQuery->get(); // Get filtered users

        // Prepare the query for all applications along with their status (approved, rejected, or pending)
        $allApplicationsQuery = McApplication::with('user');

        // Apply status filter to applications
        if ($statusFilter) {
            $allApplicationsQuery->where('status', $statusFilter);
        }

        // Apply date filters to applications
        if ($startDateFilter) {
            $allApplicationsQuery->where('start_date', '>=', $startDateFilter);
        }
        if ($endDateFilter) {
            $allApplicationsQuery->where('end_date', '<=', $endDateFilter);
        }

        // Apply role filter to applications
        if ($roleFilter) {
            $allApplicationsQuery->whereHas('user', function($query) use ($roleFilter) {
                $query->where('role', $roleFilter);
            });
        }

        // Get the filtered applications
        $allApplications = $allApplicationsQuery->get();

        // Fetch MC applications approved by officers and still pending admin approval
        $applications = McApplication::join('users', 'mc_applications.user_id', '=', 'users.id')
            ->select('mc_applications.*', 'users.name as user_name') // Select fields from mc_applications and users
            ->where('officer_approved', true)
            ->where('admin_approved', false) // Only pending admin approvals
            ->get();

        // Fetch direct admin approval applications
        $directAdminApplications = McApplication::where('direct_admin_approval', true)
            ->where('admin_approved', false) // Only fetch those not yet approved
            ->where('status', 'pending') // Only fetch pending approvals
            ->get();

        // Get today's date
        $today = now()->toDateString();

        // Get the list of staff on MC today along with their total_mc_days from users table
        $staffOnLeaveToday = McApplication::with('user') // Assuming there's a 'user' relationship in McApplication model
            ->join('users', 'mc_applications.user_id', '=', 'users.id') // Join users table
            ->where('mc_applications.start_date', '<=', $today)
            ->where('mc_applications.end_date', '>=', $today)
            ->where('mc_applications.status', 'approved') // Check for approved status
            ->select('mc_applications.*', 'users.total_mc_days', 'users.total_annual', 'users.total_others') // Select fields from both tables
            ->get();

        // Fetch all officers
        $officers = User::where('role', 'officer')->get();

        // Fetch announcements and notes
        $announcements = Announcement::all(); // Adjust as necessary to fetch announcements
        $notes = Note::all(); // Adjust as necessary to fetch notes

        // Count total MC applications and their statuses
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        // Query to get the monthly data of all staff leave applications (cuti) for the selected year
        $monthlyLeaveData = McApplication::select(
            DB::raw('MONTH(start_date) as month'),
            DB::raw('COUNT(*) as total_applications') // Count all applications regardless of user role
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
            $leaveCountsByMonth[$data->month] = $data->total_applications; // Use total_applications
        }

        // Convert leave counts to a JSON format for the chart
        $leaveCountsByMonthJson = json_encode(array_values($leaveCountsByMonth));


        // Return the view with all collected data
        return view('admin', compact(
            'directAdminApplications',
            'totalUsers',
            'users',
            'applications',
            'totalMcApplications',
            'acceptedMcApplications',
            'rejectedMcApplications',
            'announcements',
            'notes',
            'allApplications',
            'staffOnLeaveToday',
            'leaveCountsByMonth', // Keep this if you need it in the view
            'leaveCountsByMonthJson', // Pass the JSON encoded data to the view
            'officers',
            'year', // Pass selected year to view
            'yearRange' // Pass the year range to view
        ));

    }



// PENGUMUMAN ROUTES
    public function Annoucement()
    {
        // Fetch all announcements without filtering by user
        $announcements = Announcement::all();
        // Fetch total users excluding admins
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();
        $notes = Note::all(); // Retrieve all notes

        // Return the announcements view for the admin
        return view('partials.adminside.announcement', compact('announcements','totalUsers','totalMcApplications',
        'acceptedMcApplications','rejectedMcApplications','notes'));
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
        $announcement->start_date = $request->start_date;
        $announcement->end_date = $request->end_date;

        if ($request->hasFile('image_path')) {
            if ($announcement->image_path && Storage::exists('public/' . $announcement->image_path)) {
                Storage::delete('public/' . $announcement->image_path);
            }

            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->storeAs('public/announcements', $imageName);
            $announcement->image_path = 'announcements/' . $imageName;
        }

        $announcement->save();

        return redirect()->route('admin.annoucement')->with('success', 'Pengumuman berjaya dikemaskini!');

        // return redirect()->back()->with('success', 'Announcement updated successfully!');
    }

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->image_path && Storage::exists('public/announcements/' . $announcement->image_path)) {
            Storage::delete('public/announcements/' . $announcement->image_path);
        }

        $announcement->delete();

        return redirect()->route('admin.annoucement')->with('success', 'Pengumuman berjaya dipadam!');

        // Redirect back with success message
        // return redirect()->back()->with('success', 'Announcement deleted successfully!');
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('announcements', 'public');
        }
    
        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    
        return redirect()->route('admin.annoucement')->with('success', 'Pengumuman berjaya disimpan!');
    }
    
    




// NOTE ROUTES
    public function note()
    {
        $notes = Note::all(); // Fetch all notes

        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        return view('partials.adminside.note', compact('notes','totalUsers','totalMcApplications',
        'acceptedMcApplications','rejectedMcApplications')); // Correct view path
    }

    // Store a new note
    public function storeNote(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Note::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Nota berjaya disimpan!');
    }

    // Update an existing note
    public function updateNote(Request $request, $id)
    {
        $note = Note::findOrFail($id); // Find note or fail

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Nota berjaya dikemaskini!');
    }

    // Delete a note
    public function deleteNote($id)
    {
        $note = Note::findOrFail($id); // Find note or fail
        $note->delete();

        return redirect()->back()->with('success', 'Nota berjaya dipadam!');
    }





// SENARAI PEKERJA ROUTES
    public function staffList(Request $request)
    {
        // Initialize the query to fetch all users
        $usersQuery = User::query();

        // Get filter inputs
        $roleFilter = $request->input('role');        // Filter for role
        $jobStatusFilter = $request->input('job_status');  // Filter for job status

        // Apply role filter if provided
        if ($roleFilter) {
            $usersQuery->where('role', $roleFilter);
        }

        // Apply job status filter if provided
        if ($jobStatusFilter) {
            $usersQuery->where('job_status', $jobStatusFilter);
        }

        // Fetch users with pagination (10 users per page)
        $users = $usersQuery->paginate(10);

        // Fetch all officers (users with 'officer' role)
        $officers = User::where('role', 'officer')->get();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        // Pass the users and officers data to the view
        return view('partials.adminside.staff_list', [
            'users' => $users, // Now using 'users' instead of 'staff'
            'officers' => $officers,
            'totalUsers' => $totalUsers,
            'totalMcApplications' => $totalMcApplications,
            'acceptedMcApplications' => $acceptedMcApplications,
            'rejectedMcApplications' => $rejectedMcApplications,
        ]);
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        return view('editUser', compact('user')); // Return view with user data
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate input fields
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'ic' => 'nullable|string',
        'phone_number' => 'nullable|string',
        'role' => 'required|string',
        'job_status' => 'required|string',
        'selected_officer_id' => 'nullable|integer',
        'total_mc_days' => 'required|integer|min:0',
        'total_annual' => 'required|integer|min:0',
        'total_others' => 'required|integer|min:0',
        'address' => 'required|string',
        'city' => 'required|string',
        'postcode' => 'required|string',
        'state' => 'required|string',
        'fullname' => 'required|string',
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
            'selected_officer_id' => $request->selected_officer_id, // Add this line
            'total_mc_days' => $request->total_mc_days, // Ensure this matches the input name
            'total_annual' => $request->total_annual, // Ensure this matches the input name
            'total_others' => $request->total_others, // Ensure this matches the input name
            'fullname' => $request->fullname,
        ]);

        // Redirect with success message
        // return redirect()->route('admin.stafflist')->with('success', 'User updated successfully!');
        return redirect()->back()->with('success', 'Pengguna berjaya dikemaskini!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Delete the user

        // return redirect()->route('admin.stafflist')->with('success', 'User deleted successfully!');
        return redirect()->back()->with('success', 'Pengguna berjaya dipadam!');
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
            'total_mc_days' => 'required|integer|min:0',
            'total_annual' => 'required|integer|min:0',
            'total_others' => 'required|integer|min:0',
            'fullname' => 'required|string|max:255',
            'selected_officer_id' => 'nullable|integer', // Add this line to validate officer selection
            'fullname' => 'nullable|string|max:255', // Added fullname validation
        ]);

        // Create the new user
        User::create([
            'name' => $request->name,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'ic' => $request->ic,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'job_status' => $request->job_status,
            'password' => bcrypt($request->password),  // Encrypt the password
            'total_annual' => $request->total_annual,
            'total_others' => $request->total_others,
            'total_mc_days' => $request->total_mc_days,
            'address' => $request->address,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'state' => $request->state,
            'selected_officer_id' => $request->selected_officer_id, // Save selected officer ID here
            'fullname' => $request->fullname, // Added fullname field
        ]);

        // Redirect back to admin with a success message
        // return redirect()->route('admin.stafflist')->with('success', 'Kakitangan/Pegawai baru berjaya ditambah!!');
        return redirect()->back()->with('success', 'Kakitangan/Pegawai baru berjaya ditambah!');
    }




// SENARAI KESELURUHAN PERMOHONAN ROUTES
    public function showAllMcApplications(Request $request)
    {
        // Get filter inputs for search functionality
        $statusFilter = $request->input('status');
        $monthFilter = $request->input('month');
        $yearFilter = $request->input('year');
        $roleFilter = $request->input('role');
        $leaveTypeFilter = $request->input('leave_type');

        // Prepare the query for all applications along with their user data
        $allApplicationsQuery = McApplication::with('user');

        // Apply filters if provided
        if ($statusFilter) {
            $allApplicationsQuery->where('status', $statusFilter);
        }

        if ($leaveTypeFilter) {
            $allApplicationsQuery->where('leave_type', $leaveTypeFilter);
        }

        if ($roleFilter) {
            $allApplicationsQuery->whereHas('user', function ($query) use ($roleFilter) {
                $query->where('role', $roleFilter);
            });
        }

        if ($monthFilter) {
            $allApplicationsQuery->whereMonth('start_date', $monthFilter);
        }

        if ($yearFilter) {
            $allApplicationsQuery->whereYear('start_date', $yearFilter);
        }

        // Get items per page from the request, default to 10 if not provided
        $perPage = $request->input('per_page', 10);

        // Paginate the results based on the per_page value
        $allApplications = $allApplicationsQuery->paginate($perPage);

        // Calculate total statistics
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        // Pass the data to the view
        return view('partials.adminside.mc_all_apply', [
            'allApplications' => $allApplications,
            'totalUsers' => $totalUsers,
            'totalMcApplications' => $totalMcApplications,
            'acceptedMcApplications' => $acceptedMcApplications,
            'rejectedMcApplications' => $rejectedMcApplications,
        ]);
    }


    public function deleteMcApplication($id)
    {
        // Find the application by ID
        $application = McApplication::find($id);
    
        // Check if the application exists
        if (!$application) {
            return redirect()->back()->with('error', 'Permohonan tidak ditemui.');
        }
    
        // Delete the application
        $application->delete();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Permohonan berjaya dipadam!');
    }
    


// PERMOHONAN CUTI TAPISAN PEGAWAI
    public function mcOfficerApprove(Request $request)
    {
        $applications = McApplication::join('users as staff', 'mc_applications.user_id', '=', 'staff.id')
        ->leftJoin('users as officers', 'staff.selected_officer_id', '=', 'officers.id')
        ->select(
            'mc_applications.*',
            'staff.name as user_name',
            'officers.name as officer_name'
        )
        ->where('mc_applications.officer_approved', true)
        ->where('mc_applications.admin_approved', false)
        ->where('mc_applications.direct_admin_approval', false)
        ->where('mc_applications.status', 'pending_admin')
        ->paginate(10); // Change 10 to the number of items per page you want

        // Fetch all MC applications for statistical purposes
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        // Pass the data to the view
        return view('partials.adminside.mc_officer_approve', compact(
            'applications',
            'totalUsers',
            'totalMcApplications',
            'acceptedMcApplications',
            'rejectedMcApplications'
        ));
    }



// PERMOHONAN CUTI TAPISAN ADMIN
    public function mcAdminApprove(Request $request)
    {
        // Get filter inputs (if needed for future search functionality)
        $statusFilter = $request->input('status');
        $startDateFilter = $request->input('start_date');
        $endDateFilter = $request->input('end_date');

        // Prepare the query for fetching all applications (future use)
        $allApplicationsQuery = McApplication::with('user');

        // Apply status filter to all applications if provided
        if ($statusFilter) {
            $allApplicationsQuery->where('status', $statusFilter);
        }

        // Apply date filters to all applications if provided
        if ($startDateFilter) {
            $allApplicationsQuery->where('start_date', '>=', $startDateFilter);
        }
        if ($endDateFilter) {
            $allApplicationsQuery->where('end_date', '<=', $endDateFilter);
        }

        // Get all applications (this is required for future reference)
        $allApplications = $allApplicationsQuery->get();

        // Fetch direct admin approval applications: only pending and not yet admin approved
        $directAdminApplications = McApplication::where('direct_admin_approval', true)
            ->where('admin_approved', false)  // Only fetch those not yet approved
            ->where('status', 'pending')  // Only fetch those with pending status
            ->get();

        // Fetch additional statistics
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        // Pass the data to the view
        return view('partials.adminside.mc_admin_approve', compact(
            'directAdminApplications', 'allApplications', 'totalUsers',
            'totalMcApplications', 'acceptedMcApplications', 'rejectedMcApplications'
        ));
    }

// PERMOHONAN CUTI
    public function approve($id)
    {
        $application = McApplication::find($id);
    
        if (!$application) {
            return redirect()->back()->with('error', 'Permohonan tidak ditemui.');
        }
    
        // Semak sama ada ia kelulusan langsung admin atau memerlukan kelulusan pegawai
        if (!$application->direct_admin_approval && !$application->officer_approved) {
            return redirect()->back()->with('error', 'MC mesti diluluskan oleh pegawai terlebih dahulu.');
        }
    
        $startDate = Carbon::parse($application->start_date);
        $endDate = Carbon::parse($application->end_date);
    
        // Kira bilangan hari secara manual
        $daysRequested = ($endDate->timestamp - $startDate->timestamp) / (60 * 60 * 24) + 1; // Tukar saat ke hari dan tambah 1
    
        // Pastikan sekurang-kurangnya 1 hari diminta
        $daysRequested = max(1, (int)$daysRequested);
    
        // Cari pengguna yang menghantar permohonan
        $user = User::find($application->user_id);
    
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemui.');
        }
    
        // Tolak berdasarkan jenis cuti
        switch ($application->leave_type) {
            case 'annual':
                if ($user->total_annual >= $daysRequested) {
                    $user->total_annual -= $daysRequested;
                } else {
                    return redirect()->back()->with('error', 'Hari cuti tahunan tidak mencukupi.');
                }
                break;
    
            case 'mc':
                if ($user->total_mc_days >= $daysRequested) {
                    $user->total_mc_days -= $daysRequested;
                } else {
                    return redirect()->back()->with('error', 'Hari cuti MC tidak mencukupi.');
                }
                break;
    
            case 'other':
                if ($user->total_others >= $daysRequested) {
                    $user->total_others -= $daysRequested;
                } else {
                    return redirect()->back()->with('error', 'Hari cuti lain tidak mencukupi.');
                }
                break;
    
            default:
                return redirect()->back()->with('error', 'Jenis cuti tidak sah.');
        }
    
        // Simpan maklumat pengguna yang dikemas kini
        $user->save();
    
        // Kemas kini status permohonan kepada diluluskan
        $application->admin_approved = true;
        $application->status = 'approved';
        $application->save();
    
        return redirect()->back()->with('success', 'Permohonan cuti telah diluluskan oleh admin.'); // Mesej kejayaan
    }
    


    public function reject(Request $request, $id)
    {
        $application = McApplication::find($id);

        if (!$application) {
            return redirect()->back()->with('error', 'Application not found.');
        }

        // Optionally, check if the application can be rejected
        if ($application->status === 'approved') {
            return redirect()->back()->with('error', 'Cannot reject an already approved application.');
        }

        // Validate the reason
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Update the application's status to rejected
        $application->status = 'rejected';
        $application->admin_approved = false; // Optionally set this to false
        $application->rejection_reason = $request->reason; // Save the reason for rejection
        $application->save();

        return redirect()->back()->with('success', 'MC application rejected by admin. Reason: ' . $request->reason);
    }





// PROFILE PENGGUNA ROUTES
    public function showProfile()
    {
        // Fetch the necessary data for the profile view, such as the logged-in user's information
        $user = auth()->user(); // Example: get the authenticated user
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();

        // Return the profile view with the user data
        return view('partials.adminside.profile', compact('user','totalUsers',
        'totalMcApplications','acceptedMcApplications','rejectedMcApplications')); // Ensure you have a view named 'profile'
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
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'state' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for profile image
            'fullname' => 'nullable|string|max:255',
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
        return redirect()->back()->with('success', 'Your details have been updated successfully!');
    }



// PASSWORD ROUTES
    public function password()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();
        return view('partials.adminside.password',compact('totalUsers','totalMcApplications','acceptedMcApplications','rejectedMcApplications'));
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
