<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\Auth\LoginController;


// GENERAL ROUES:

    // Home/Login page:
    Route::get('/', function () {
        return view('login');
    });



// AUTHENTICATION ROUTES

    // Login:
        // Route for logging in
        Route::post('/login',                                 [LoginController::class, 'login'])->name('login');
    // Logout:
        // Route for logging out
        Route::post('/logout',                                [LoginController::class, 'logout'])->name('logout');

    // Route after login
        Route::get('/staff', [StaffController::class, 'index'])->name('staff');
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
        Route::get('/officer', [OfficerController::class, 'index'])->name('officer');



// ADMIN ROUTES

    // Dashboard:
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    // User Management:
        // Routes for adding, editing, updating, and deleting users.
        Route::post('/admin/store',                           [AdminController::class, 'storeUser'])->name('storeUser');
        Route::get('/admin/edit/{id}',                        [AdminController::class, 'editUser'])->name('editUser');
        // Route for updating a user (after form submission)
        Route::post('/admin/update/{id}',                     [AdminController::class, 'updateUser'])->name('updateUser');
        // Route for deleting a user
        Route::delete('/admin/delete/{id}',                   [AdminController::class, 'deleteUser'])->name('deleteUser');


    // MC Application Approval (Admin Side):
        // Admin & Officer MC Approval/Rejection:
        // Routes for approving or rejecting MC applications by both admins and officers.
        Route::post('/admin/approve/{id}',                    [AdminController::class, 'approveMcApplication'])->name('admin.approveMcApplication');
        // Admin approval route
        Route::post('/mc-applications/{id}/admin-approve',    [AdminController::class, 'approve'])->name('admin.approve');
        // Admin reject route
        Route::post('/mc-applications/{id}/admin-reject',     [AdminController::class, 'reject'])->name('admin.reject');


    // Announcement Management:
        // Admin Announcements: Routes for managing announcements (create, update, delete)
        Route::post('/admin/announcements',                   [AdminController::class, 'storeAnnouncement'])->name('admin.storeAnnouncement');
        Route::put('/admin/announcements/{id}',               [AdminController::class, 'updateAnnouncement'])->name('updateAnnouncement');
        Route::delete('/admin/delete-announcement/{id}',      [AdminController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');

    // Admin Profile Management:
        Route::get('/admin/edit-profile', function () {
            return view('partials.adminside.edit-profile');
        })->name('admin.editProfile');

    // Admin Routes
        Route::post('/admin/approve/{id}',                    [AdminController::class, 'approve'])->name('admin.approve');

    // Route for updating own details
        Route::post('/admin/update-details',                  [AdminController::class, 'updateOwnDetails'])->name('updateOwnDetails');



// OFFICER ROUTES

    // MC Application Approval (Officer Side):
        // Accept and reject staff application for officer side
        Route::post('/officer/update-status/{id}',            [OfficerController::class, 'updateStatus'])->name('officer.updateStatus');
        // Officer approval route
        Route::post('/mc-applications/{id}/officer-approve',  [OfficerController::class, 'approve'])->name('officer.approve');

    // Officer Profile Management:
        Route::get('/officer/edit-profile', function () {
            return view('partials.officerside.edit-profile');
        })->name('officer.editProfile');

        // MC Application Handling (Officer Side):
        Route::post('/officer/mc-application',                [OfficerController::class, 'storeMcApplication'])->name('officer.mcApplication.store');
        // Edit the mc application if any changes
        Route::post('/officer/mc-application/edit/{id}',      [OfficerController::class, 'editMC'])->name('officer.mc.edit');
        // Delete mc application for rejected only
        Route::delete('/officer/mc-application/{id}',         [OfficerController::class, 'deleteMC'])->name('officer.deleteMC');

        // Display staffmc application route
        Route::get('/officer',                                [OfficerController::class, 'index'])->name('officer');

        // Route for updating own details
        Route::post('/officer/update-details',                [OfficerController::class, 'updateOwnDetails3'])->name('updateOwnDetails3');



// STAFF ROUTES

    // MC Application Handling (Staff Side):
        // Routes for staff to submit, edit, and delete MC applications
        Route::post('/staff/mc-application',                  [StaffController::class, 'storeMcApplication'])->name('staff.mc.submit');
        // Edit the mc application if any changes
        Route::post('/staff/mc-application/edit/{id}',        [StaffController::class, 'editMC'])->name('staff.mc.edit');
        // Delete mc application for rejected only
        Route::delete('/staff/mc-application/{id}',           [StaffController::class, 'deleteMC'])->name('staff.deleteMC');

        // Staff Routes
        Route::get('/staff',                                   [StaffController::class, 'dashboard'])->name('staff'); // D (this replaces the previous '/staff' view route)

        // Route for submitting MC application
        Route::post('/staff/mc-application',                   [StaffController::class, 'storeMcApplication'])->name('staff.mc.submit');

        // Edit the mc application if any changes
        Route::post('/staff/mc-application/edit/{id}',         [StaffController::class, 'editMC'])->name('staff.mc.edit');

        // Route for updating own details
        Route::post('/staff/update-details',                   [StaffController::class, 'updateOwnDetails2'])->name('updateOwnDetails2');

        Route::get('/profile', [StaffController::class, 'profile'])->name('profile');
        Route::get('/password', [StaffController::class, 'password'])->name('password');
        Route::get('/mc_application', [StaffController::class, 'McApply'])->name('McApply');
