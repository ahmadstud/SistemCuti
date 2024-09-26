<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/staff', function () {
    return view('staff');
})->name('staff');

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');

Route::get('/officer', function () {
    return view('officer');
})->name('officer');


Route::get('/admin/edit/{id}', [AdminController::class, 'editUser'])->name('editUser');

// Route for updating a user (after form submission)
Route::post('/admin/update/{id}', [AdminController::class, 'updateUser'])->name('updateUser');

// Route for deleting a user
Route::delete('/admin/delete/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
Route::delete('/admin/delete-announcement/{id}', [AdminController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');
Route::post('/admin/store', [AdminController::class, 'storeUser'])->name('storeUser');
Route::post('/admin/approve/{id}', [AdminController::class, 'approveMcApplication'])->name('admin.approveMcApplication');
// Route for updating own details
Route::post('/admin/update-details', [AdminController::class, 'updateOwnDetails'])->name('updateOwnDetails');

// Route for updating own details
Route::post('/staff/update-details', [StaffController::class, 'updateOwnDetails2'])->name('updateOwnDetails2');

// Route for updating own details
Route::post('/officer/update-details', [OfficerController::class, 'updateOwnDetails3'])->name('updateOwnDetails3');

Route::post('/staff/mc-application', [StaffController::class, 'storeMcApplication'])->name('staff.mc.submit');
// D
Route::get('/staff', [StaffController::class, 'index'])->name('staff');
// Delete mc application for rejected only
Route::delete('/staff/mc-application/{id}', [StaffController::class, 'deleteMC'])->name('staff.deleteMC');
// Edit the mc application if any changes
Route::post('/staff/mc-application/edit/{id}', [StaffController::class, 'editMC'])->name('staff.mc.edit');
// Display staffmc application route
Route::get('/officer', [OfficerController::class, 'index'])->name('officer');
// Accept and reject staff application for officer side
Route::post('/officer/update-status/{id}', [OfficerController::class, 'updateStatus'])->name('officer.updateStatus');

// Officer approval route
Route::post('/mc-applications/{id}/officer-approve', [OfficerController::class, 'approve'])->name('officer.approve');

// Admin approval route
Route::post('/mc-applications/{id}/admin-approve', [AdminController::class, 'approve'])->name('admin.approve');
// Admin reject route
Route::post('/mc-applications/{id}/admin-reject', [AdminController::class, 'reject'])->name('admin.reject');

// Route for submitting MC application
Route::post('/staff/mc-application', [StaffController::class, 'storeMcApplication'])->name('staff.mc.submit');

Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
Route::post('/admin/announcements', [AdminController::class, 'storeAnnouncement'])->name('admin.storeAnnouncement');
Route::put('/admin/announcements/{id}', [AdminController::class, 'updateAnnouncement'])->name('updateAnnouncement');

Route::get('/officer/edit-profile', function () {
    return view('partials.officerside.edit-profile');
})->name('officer.editProfile');

Route::post('/officer/mc-application', [OfficerController::class, 'storeMcApplication'])
->name('officer.mcApplication.store');

// Edit the mc application if any changes
Route::post('/officer/mc-application/edit/{id}', [OfficerController::class, 'editMC'])->name('officer.mc.edit');

// Delete mc application for rejected only
Route::delete('/officer/mc-application/{id}', [OfficerController::class, 'deleteMC'])->name('officer.deleteMC');

Route::get('/staff/edit-profile', function () {
    return view('partials.staffside.edit-profile');
})->name('staff.editProfile');

Route::get('/admin/edit-profile', function () {
    return view('partials.adminside.edit-profile');
})->name('admin.editProfile');

Route::get('/officer/edit-profile', function () {
    return view('partials.officerside.edit-profile');
})->name('officer.editProfile');

Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');



