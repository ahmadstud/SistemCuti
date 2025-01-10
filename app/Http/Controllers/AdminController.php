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
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

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

    // Generate column names from the note title
    $baseColumnName = Str::slug($request->title, '_');
    $fixedColumnName = "total_{$baseColumnName}";

    // Check if the columns already exist to avoid duplication
    if (!Schema::hasColumn('users', $baseColumnName) && !Schema::hasColumn('users', $fixedColumnName)) {
        // Alter the table to add new columns
        Schema::table('users', function (Blueprint $table) use ($baseColumnName, $fixedColumnName) {
            $table->integer($baseColumnName)->nullable()->default(0);
            $table->integer($fixedColumnName)->nullable()->default(0);
        });
    }

    // Store the note content or other relevant information
    Note::create([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->back()->with('success', 'Nota berjaya ditambah!');
}

// Update an existing note
public function updateNote(Request $request, $id)
{
    $note = Note::findOrFail($id); // Find note or fail

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    // Get the old and new column names
    $oldBaseColumnName = Str::slug($note->title, '_');
    $oldFixedColumnName = "total_{$oldBaseColumnName}";
    $newBaseColumnName = Str::slug($request->title, '_');
    $newFixedColumnName = "total_{$newBaseColumnName}";

    // If the title has changed, rename the columns
    if ($oldBaseColumnName !== $newBaseColumnName) {
        Schema::table('users', function (Blueprint $table) use ($oldBaseColumnName, $oldFixedColumnName, $newBaseColumnName, $newFixedColumnName) {
            $table->renameColumn($oldBaseColumnName, $newBaseColumnName);
            $table->renameColumn($oldFixedColumnName, $newFixedColumnName);
        });
    }

    // Update the note's title and content
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

    // Get the column names
    $baseColumnName = Str::slug($note->title, '_');
    $fixedColumnName = "total_{$baseColumnName}";

    // Drop the columns
    Schema::table('users', function (Blueprint $table) use ($baseColumnName, $fixedColumnName) {
        $table->dropColumn([$baseColumnName, $fixedColumnName]);
    });

    $note->delete();

    return redirect()->back()->with('success', 'Nota berjaya dipadam!');
}

    // SENARAI PEKERJA ROUTES
    public function staffList(Request $request)
    {
        // Initialize the query to fetch all users
        $usersQuery = User::query();

        // Get filter inputs (Ensure the filter inputs are correctly named in your form)
        $roleFilter = $request->input('role'); // Filter for role
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
        $notes = Note::all(); // Adjust as necessary to fetch notes

        // Pass the users and officers data to the view
        return view('partials.adminside.staff_list', [
            'users' => $users, // Now using 'users' instead of 'staff'
            'officers' => $officers,
            'totalUsers' => $totalUsers,
            'totalMcApplications' => $totalMcApplications,
            'acceptedMcApplications' => $acceptedMcApplications,
            'rejectedMcApplications' => $rejectedMcApplications,
            'notes' => $notes,
        ]);
    }



    public function editUser($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        return view('editUser', compact('user')); // Return view with user data
    }

    public function updateUser(Request $request, $id)
    {
        \Log::info($request->all()); // Log all incoming request data for debugging

        // Validate the incoming request data (basic fields)
        $request->validate([
            'fullname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'ic' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'role' => 'required|string',
            'job_status' => 'required|string',
            'selected_officer_id' => 'nullable|exists:users,id',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Automatically fill user data from the request, including static fields
        $user->fill($request->all());

        // Handle notes
        $notes = Note::all(); // Retrieve all notes
        foreach ($notes as $note) {
            $baseColumnName = Str::slug($note->title, '_'); // Base column (e.g., `cuti_harian`)
            $fixedColumnName = "total_{$baseColumnName}"; // Fixed column (e.g., `total_cuti_harian`)

            // Update the dynamic column value if provided in the request
            if ($request->has($baseColumnName)) {
                $user->$baseColumnName = $request->input($baseColumnName);
            }

            // Update the fixed column value if provided in the request
            if ($request->has($fixedColumnName)) {
                $user->$fixedColumnName = $request->input($fixedColumnName);
            }
        }

        // Save the updated user information
        $user->save();

        // Redirect with success message
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
            'fullname' => 'required|string|max:255',
            'selected_officer_id' => 'nullable|integer',
            // Removed duplicate fullname validation
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'ic' => $request->ic,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'job_status' => $request->job_status,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'state' => $request->state,
            'selected_officer_id' => $request->selected_officer_id,
        ]);

        // Handle notes
        $notes = Note::all(); // Assuming you have a Note model to retrieve all notes
        foreach ($notes as $note) {
            $columnName = Str::slug($note->title, '_');
            if ($request->has($columnName)) {
                $user->$columnName = $request->input($columnName); // Set the note value
            }
        }

        $user->save(); // Save the user with the notes

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
        $notes = Note::all(); // Fetch all notes

        // Create an array to hold selected leave types
        $selectedLeaveTypes = [];

        foreach ($allApplications as $application) {
            // Find the note where the title matches the leave_type
            $note = $notes->firstWhere('title', $application->leave_type);
            if ($note) {
                // Store the title of the selected leave type
                $selectedLeaveTypes[$application->id] = $note->title;
            } else {
                $selectedLeaveTypes[$application->id] = 'Tidak ada catatan dipilih';
            }
        }

        // Pass the data to the view
        return view('partials.adminside.mc_all_apply', compact('allApplications','totalUsers'
        ,'totalMcApplications','acceptedMcApplications','rejectedMcApplications','notes','selectedLeaveTypes'));
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

    // public function generateStaffPdf(Request $request)
    // {
    //     // Fetch the filtered data, similar to the `staffList` function
    //     $usersQuery = User::query();
    //     $roleFilter = $request->input('role');
    //     $jobStatusFilter = $request->input('job_status');

    //     if ($roleFilter) {
    //         $usersQuery->where('role', $roleFilter);
    //     }

    //     if ($jobStatusFilter) {
    //         $usersQuery->where('job_status', $jobStatusFilter);
    //     }

    //     $users = $usersQuery->get();

    //     // Pass the data to a dedicated Blade view for PDF
    //     $pdf = Pdf::loadView('partials.adminside.staff_pdf', ['users' => $users]);

    //     // Return the generated PDF for download
    //     return $pdf->download('staff_list.pdf');
    // }

    public function generateApplicationsPdf(Request $request)
    {
        $applications = McApplication::with('user')->get(); // Fetch all applications
        $pdf = PDF::loadView('partials.adminside.mc_applications_pdf', compact('applications'));
        return $pdf->download('mc_applications.pdf');
    }

    public function generateApplicationsExcel()
    {
        // Fetch all applications with user data
        $applications = McApplication::with('user')->get();

        // Set the filename and headers for Excel
        $filename = "mc_applications_" . date('Y-m-d') . ".csv";
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Expires" => "0",
        ];

        // Callback to write data to the file
            $callback = function () use ($applications) {
            // Open the output stream
            $file = fopen('php://output', 'w');

            // Add the column headers
            fputcsv($file, ['No.', 'User Name', 'Leave Type', 'Start Date', 'End Date', 'Reason', 'Status']);

            // Add rows for each application
            $index = 0;
            foreach ($applications as $application) {
                $index++;
                fputcsv($file, [
                    $index, // No.
                    $application->user->name, // User Name
                    $application->leave_type, // Leave Type
                    \Carbon\Carbon::parse($application->start_date)->format('d/m/Y'), // Start Date
                    \Carbon\Carbon::parse($application->end_date)->format('d/m/Y'), // End Date
                    $application->reason, // Reason
                    $application->status, // Status
                ]);
            }

            // Close the file
            fclose($file);
        };


        // Return a streamed response
        return response()->stream($callback, 200, $headers);
    }




    // PERMOHONAN CUTI KESELURUHAN
    public function mcAllApply(Request $request)
    {
        // Get filter inputs for searching and filtering (optional for future use)
        $statusFilter = $request->input('status');
        $startDateFilter = $request->input('start_date');
        $endDateFilter = $request->input('end_date');

        // Prepare the query for fetching all applications
        $allApplicationsQuery = McApplication::join('users as staff', 'mc_applications.user_id', '=', 'staff.id')
            ->leftJoin('users as officers', 'staff.selected_officer_id', '=', 'officers.id')
            ->select(
                'mc_applications.*',
                'staff.name as user_name',
                'officers.name as officer_name'
            );

        // Apply status filter if provided
        if ($statusFilter) {
            $allApplicationsQuery->where('mc_applications.status', $statusFilter);
        }

        // Apply date filters if provided
        if ($startDateFilter) {
            $allApplicationsQuery->where('mc_applications.start_date', '>=', $startDateFilter);
        }
        if ($endDateFilter) {
            $allApplicationsQuery->where('mc_applications.end_date', '<=', $endDateFilter);
        }

        // Paginate the applications for better display
        $allApplications = $allApplicationsQuery->paginate(10); // Change 10 to the desired number of items per page

        // Fetch statistics for displaying overall data
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();
        $notes = Note::all(); // Fetch all notes for leave types

        // Create an array to hold selected leave types
        $selectedLeaveTypes = [];

        foreach ($allApplications as $application) {
            // Find the note where the title matches the leave_type
            $note = $notes->firstWhere('title', $application->leave_type);
            if ($note) {
                // Store the title of the selected leave type
                $selectedLeaveTypes[$application->id] = $note->title;
            } else {
                $selectedLeaveTypes[$application->id] = 'Tidak ada catatan dipilih';
            }
        }

        // Pass the data to the view
        return view('partials.adminside.mc_all_apply', compact(
            'allApplications', 'totalUsers', 'totalMcApplications',
            'acceptedMcApplications', 'rejectedMcApplications',
            'notes', 'selectedLeaveTypes'
        ));
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
        $notes = Note::all(); // Fetch all notes

        // Create an array to hold selected leave types
        $selectedLeaveTypes = [];

        foreach ($applications as $application) {
            // Find the note where the title matches the leave_type
            $note = $notes->firstWhere('title', $application->leave_type);
            if ($note) {
                // Store the title of the selected leave type
                $selectedLeaveTypes[$application->id] = $note->title;
            } else {
                $selectedLeaveTypes[$application->id] = 'Tidak ada catatan dipilih';
            }
        }
        // Pass the data to the view
        return view('partials.adminside.mc_officer_approve', compact(
            'applications',
            'totalUsers',
            'totalMcApplications',
            'acceptedMcApplications',
            'rejectedMcApplications',
            'notes',
            'selectedLeaveTypes'
        ));
    }



// PERMOHONAN CUTI TAPISAN ADMIN1
    // public function mcAdminApprove(Request $request)
    // {
    //     // Get filter inputs (if needed for future search functionality)
    //     $statusFilter = $request->input('status');
    //     $startDateFilter = $request->input('start_date');
    //     $endDateFilter = $request->input('end_date');

    //     // Prepare the query for fetching all applications (future use)
    //     $allApplicationsQuery = McApplication::with('user');

    //     // Apply status filter to all applications if provided
    //     if ($statusFilter) {
    //         $allApplicationsQuery->where('status', $statusFilter);
    //     }

    //     // Apply date filters to all applications if provided
    //     if ($startDateFilter) {
    //         $allApplicationsQuery->where('start_date', '>=', $startDateFilter);
    //     }
    //     if ($endDateFilter) {
    //         $allApplicationsQuery->where('end_date', '<=', $endDateFilter);
    //     }

    //     // Get all applications (this is required for future reference)
    //     $allApplications = $allApplicationsQuery->get();

    //     // Fetch direct admin approval applications: only pending and not yet admin approved
    //     $directAdminApplications = McApplication::where('direct_admin_approval', true)
    //         ->where('admin_approved', false)  // Only fetch those not yet approved
    //         ->where('status', 'pending')  // Only fetch those with pending status
    //         ->get();

    //     // Fetch additional statistics
    //     $totalUsers = User::where('role', '!=', 'admin')->count();
    //     $totalMcApplications = McApplication::count();
    //     $acceptedMcApplications = McApplication::where('status', 'approved')->count();
    //     $rejectedMcApplications = McApplication::where('status', 'rejected')->count();
    //     $notes = Note::all(); // Fetch all notes

    //     // Create an array to hold selected leave types
    //     $selectedLeaveTypes = [];

    //     foreach ($directAdminApplications as $application) {
    //         // Find the note where the title matches the leave_type
    //         $note = $notes->firstWhere('title', $application->leave_type);
    //         if ($note) {
    //             // Store the title of the selected leave type
    //             $selectedLeaveTypes[$application->id] = $note->title;
    //         } else {
    //             $selectedLeaveTypes[$application->id] = 'Tidak ada catatan dipilih';
    //         }
    //     }
    //     // Pass the data to the view
    //     return view('partials.adminside.mc_admin_approve', compact(
    //         'directAdminApplications', 'allApplications', 'totalUsers',
    //         'totalMcApplications', 'acceptedMcApplications', 'rejectedMcApplications',
    //         'notes','selectedLeaveTypes'
    //     ));
    // }

    public function mcAdminApprove(Request $request)
    {
        // Prepare the query for fetching all applications not approved by admin and not rejected
        $pendingApplications = McApplication::join('users as staff', 'mc_applications.user_id', '=', 'staff.id')
            ->leftJoin('users as officers', 'staff.selected_officer_id', '=', 'officers.id')
            ->select(
                'mc_applications.*',
                'staff.name as user_name',
                'officers.name as officer_name'
            )
            ->where('mc_applications.admin_approved', false) // Not yet approved by admin
            ->where('mc_applications.status', '!=', 'rejected') // Exclude rejected applications
            ->where(function ($query) {
                $query->where('mc_applications.direct_admin_approval', true) // Directly from staff
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('mc_applications.officer_approved', true) // Approved by officer
                                ->where('mc_applications.direct_admin_approval', false); // Not direct admin approval
                    });
            })
            ->paginate(10); // Paginate results
    
        // Fetch additional statistics
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalMcApplications = McApplication::count();
        $acceptedMcApplications = McApplication::where('status', 'approved')->count();
        $rejectedMcApplications = McApplication::where('status', 'rejected')->count();
        $notes = Note::all(); // Fetch all notes
    
        // Map leave types for pending applications
        $selectedLeaveTypes = [];
        foreach ($pendingApplications as $application) {
            $note = $notes->firstWhere('title', $application->leave_type);
            $selectedLeaveTypes[$application->id] = $note ? $note->title : 'Tidak ada catatan dipilih';
        }
    
        // Pass data to the view
        return view('partials.adminside.mc_admin_approve', compact(
            'pendingApplications', 'totalUsers', 'totalMcApplications',
            'acceptedMcApplications', 'rejectedMcApplications', 'notes', 'selectedLeaveTypes'
        ));
    }
    





   // PERMOHONAN CUTI
    public function approve($id)
    {
        $application = McApplication::find($id);

        if (!$application) {
            Log::error('Application not found.', ['application_id' => $id]);
            return redirect()->back()->with('error', 'Application not found.');
        }

        // Check if it's direct admin approval or needs officer approval
        if (!$application->direct_admin_approval && !$application->officer_approved) {
            Log::warning('MC application not approved by officer.', ['application_id' => $id]);
            return redirect()->back()->with('error', 'MC must be approved by an officer first.');
        }

        $startDate = Carbon::parse($application->start_date);
        $endDate = Carbon::parse($application->end_date);

        // Calculate the number of days manually
        $daysRequested = ($endDate->timestamp - $startDate->timestamp) / (60 * 60 * 24) + 1; // Convert seconds to days and add 1
        $daysRequested = max(1, (int)$daysRequested); // Ensure at least 1 day is requested

        // Find the user who submitted the application
        $user = User::find($application->user_id);

        if (!$user) {
            Log::error('User not found.', ['user_id' => $application->user_id, 'application_id' => $id]);
            return redirect()->back()->with('error', 'User not found.');
        }

        // Handle notes deduction dynamically
        $notes = Note::all(); // Retrieve all notes
        $noteColumn = Str::slug($application->leave_type, '_'); // Slug the leave type for matching

        // Check if the requested leave type corresponds to any note
        foreach ($notes as $note) {
            $columnName = Str::slug($note->title, '_'); // Slug the note title

            if ($columnName === $noteColumn && isset($user->$columnName) && $user->$columnName >= $daysRequested) {
                $user->$columnName -= $daysRequested; // Deduct the requested days from the notes column
                Log::info('Deducted notes days.', ['user_id' => $user->id, 'days_deducted' => $daysRequested, 'note_type' => $note->title]);
                break; // Exit the loop once the deduction is made
            }
        }

        // Check if the deduction was successful
        if (!isset($user->$noteColumn) || $user->$noteColumn < $daysRequested) {
            Log::warning('Insufficient notes available.', ['user_id' => $user->id, 'requested' => $daysRequested, 'available' => $user->$noteColumn ?? 0]);
            return redirect()->back()->with('error', 'Insufficient notes available.');
        }

        // Save the updated user information
        $user->save();

        // Update the application's status to approved
        $application->admin_approved = true;
        $application->status = 'approved';
        $application->save();

        Log::info('MC application approved.', ['application_id' => $id, 'user_id' => $user->id]);

        return redirect()->back()->with('success', 'MC application approved by admin.');
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
        return redirect()->back()->with('update_success', true);
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
