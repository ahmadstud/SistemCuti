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
        Route::post('/login',                                   [LoginController::class, 'login'])->name('login');
    // Logout:
        // Route for logging out
        Route::
        post('/logout',                                  [LoginController::class, 'logout'])->name('logout');

        Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset.password');

    // Route after login
        Route::get('/staff',                                    [StaffController::class, 'dashboard'])->name('staff');
        Route::get('/admin',                                    [AdminController::class, 'dashboard'])->name('admin');
        Route::get('/officer',                                  [OfficerController::class, 'dashboard'])->name('officer');

// ADMIN ROUTES

        // Dashboard:
            Route::get('/admin/dashboard',                              [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // User Management:
        // Routes for adding, editing, updating, and deleting users.
            Route::post('/admin/store',                             [AdminController::class, 'storeUser'])->name('storeUser');
            Route::get('/admin/edit/{id}',                          [AdminController::class, 'editUser'])->name('editUser');
        // Route for updating a user (after form submission)
            Route::post('/admin/update/{id}',                       [AdminController::class, 'updateUser'])->name('updateUser');
        // Route for deleting a user
            Route::delete('/admin/delete/{id}',                     [AdminController::class, 'deleteUser'])->name('deleteUser');


        // Announcement Management:
            Route::get('/admin/annoucement',                        [AdminController::class, 'Annoucement'])->name('admin.annoucement');
            Route::post('/admin/announcements',                     [AdminController::class, 'storeAnnouncement'])->name('admin.storeAnnouncement');
            Route::put('/admin/announcements/{id}',                 [AdminController::class, 'updateAnnouncement'])->name('updateAnnouncement');
            Route::delete('/admin/delete-announcement/{id}',        [AdminController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');


        // Note Management:
        Route::get('/notes',                                        [AdminController::class, 'note'])->name('admin.nota');

            Route::get('/admin/annoucement/notes',                  [AdminController::class, 'Notes'])->name('admin.notes');
            Route::post('/admin/annoucement/notes',                 [AdminController::class, 'storeNote'])->name('admin.storeNote');
            Route::put('/admin/annoucement/notes/{id}',             [AdminController::class, 'updateNote'])->name('updateNote');
            Route::delete('/admin/delete-note/{id}',                [AdminController::class, 'deleteNote'])->name('deleteNote');



        // MC Application Approval (Admin Side):
            Route::get('/admin/mc-all-apply',                       [AdminController::class, 'showAllMcApplications'])->name('admin.mcAllApply');
            
            Route::delete('/applications/{id}', [AdminController::class, 'deleteMcApplication'])->name('applications.delete');

        // generating the PDF
            // Route::get('/staff-list/generate-pdf', [AdminController::class, 'generateStaffPdf'])->name('staffList.generatePdf');
            Route::get('/admin/mc-all-apply/pdf', [AdminController::class, 'generateApplicationsPdf'])->name('admin.mcAllApplyPdf');
            Route::get('/admin/mc-all-apply/excel', [AdminController::class, 'generateApplicationsExcel'])->name('admin.mcAllApplyExcel');
            

        // Routes for approving or rejecting MC applications by both admins and officers.
            Route::post('/admin/approve/{id}',                      [AdminController::class, 'approveMcApplication'])->name('admin.approveMcApplication');
        // Admin approval route
            Route::post('/admin/mc-applications/{id}/admin-approve',[AdminController::class, 'approve'])->name('admin.approve');
        // Admin reject route
            Route::post('/admin/mc-applications/{id}/admin-reject', [AdminController::class, 'reject'])->name('admin.reject');




        // Admin Routes
            Route::post('/admin/approve/{id}',                    [AdminController::class, 'approve'])->name('admin.approve');


        // Officer MC Approval:
            Route::get('/admin/mc-officer-approve',                 [AdminController::class, 'mcOfficerApprove'])->name('admin.mcOfficerApprove');

        // Admin MC Approval:
            Route::get('/admin/mc-admin-approve',                   [AdminController::class, 'mcAdminApprove'])->name('admin.mcAdminApprove');

        // Profile Management:
            Route::get('/admin/profile',                            [AdminController::class, 'showProfile'])->name('admin.profile');

        // Route for updating own details
        Route::post('/admin/update-details',                        [AdminController::class, 'updateOwnDetails'])->name('updateOwnDetails');

        // Password Management:
        Route::get('/admin/password',                               [AdminController::class, 'password'])->name('admin.password');
        Route::post('/change-password',                             [AdminController::class, 'changePassword'])->name('changePassword');

        // Staff List:
        Route::get('/admin/staff-list',                             [AdminController::class, 'staffList'])->name('admin.stafflist');

        Route::get('/admin/mc-all-apply',                           [AdminController::class, 'showAllMcApplications'])->name('admin.mcAllApply');

        Route::get('/admin/mc-officer-approve',                     [AdminController::class, 'mcOfficerApprove'])->name('admin.mcOfficerApprove');
        Route::post('/admin/approve/{id}',                          [AdminController::class, 'approve'])->name('admin.approve');
        Route::post('/admin/reject/{id}',                           [AdminController::class, 'reject'])->name('admin.reject');


// OFFICER ROUTES

    // MC Application Approval (Officer Side):
        // Accept and reject staff application for officer side
        Route::post('/officer/update-status/{id}',            [OfficerController::class, 'updateStatus'])->name('officer.updateStatus');
        // Officer approval route
        Route::post('/mc-applications/{id}/officer-approve',  [OfficerController::class, 'approve'])->name('officer.approve');

        // MC Application Handling (Officer Side):
        Route::post('/officer/mc-application',                [OfficerController::class, 'storeMcApplication'])->name('officer.mcApplication.store');
        // Edit the mc application if any changes
        Route::post('/officer/mc-application/edit/{id}',      [OfficerController::class, 'editMC'])->name('officer.mc.edit');
        // Delete mc application for rejected only
        Route::delete('/officer/mc-application/{id}',         [OfficerController::class, 'deleteMC'])->name('officer.deleteMC');

        // Route for updating own details
        Route::post('/officer/update-details',                [OfficerController::class, 'updateOwnDetails3'])->name('updateOwnDetails3');

         // Dashboard:
         Route::get('/officer/dashboard',                              [OfficerController::class, 'dashboard'])->name('officer.dashboard');

        // Routes for officers
        Route::prefix('officer')->name('officer.')->group(function () {
            Route::get('/profile', [OfficerController::class, 'profile'])->name('profile');
            Route::get('/password', [OfficerController::class, 'password'])->name('password');
            Route::get('/mc_application', [OfficerController::class, 'McApply'])->name('mc_application');
            Route::get('/mc_approve', [OfficerController::class, 'McApprove'])->name('mc_approve');
            Route::post('/change-password', [OfficerController::class, 'changePassword'])->name('changePassword');
        });

// STAFF ROUTES

    // MC Application Handling (Staff Side):
        // Routes for staff to submit, edit, and delete MC applications
        Route::post('/staff/mc-application',                  [StaffController::class, 'storeMcApplication'])->name('staff.mc.submit');
        // Edit the mc application if any changes
        Route::post('/staff/mc-application/edit/{id}',        [StaffController::class, 'editMC'])->name('staff.mc.edit');
        // Delete mc application for rejected only
        Route::delete('/staff/mc-application/{id}',           [StaffController::class, 'deleteMC'])->name('staff.deleteMC');

        // Route for submitting MC application
        Route::post('/staff/mc-application',                   [StaffController::class, 'storeMcApplication'])->name('staff.mc.submit');

        // Edit the mc application if any changes
        Route::post('/staff/mc-application/edit/{id}',         [StaffController::class, 'editMC'])->name('staff.mc.edit');

        // Route for updating own details
        Route::post('/staff/update-details',                   [StaffController::class, 'updateOwnDetails2'])->name('updateOwnDetails2');

         // Dashboard:
         Route::get('/staff/dashboard',                              [StaffController::class, 'dashboard'])->name('staff.dashboard');

        // Routes for officers
        Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/profile', [StaffController::class, 'profile'])->name('profile');
        Route::get('/password', [StaffController::class, 'password'])->name('password');
        Route::get('/mc_application', [StaffController::class, 'McApply'])->name('mc_application');
        Route::post('/change-password', [StaffController::class, 'changePassword'])->name('changePassword');
    });




