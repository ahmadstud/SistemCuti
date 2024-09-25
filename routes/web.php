<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('login');
});

Route::post('/login',                                [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout',                               [LoginController::class, 'logout'])->name('logout');


Route::get('/staff', function () {
    return view('staff');
})->name('staff');

Route::get('/admin',                                  [AdminController::class, 'dashboard'])          ->name('admin');

Route::get('/officer', function () {
    return view('officer');
})->name('officer');


Route::get('/admin/edit/{id}',                        [AdminController::class, 'editUser'])            ->name('editUser');

// Route for updating a user (after form submission)
Route::post('/admin/update/{id}',                     [AdminController::class, 'updateUser'])          ->name('updateUser');


// Route for deleting a user
Route::delete('/admin/delete/{id}',                   [AdminController::class, 'deleteUser'])          ->name('deleteUser');
Route::post('/admin/store',                           [AdminController::class, 'storeUser'])           ->name('storeUser');
Route::post('/admin/approve/{id}',                    [AdminController::class, 'approveMcApplication'])->name('admin.approveMcApplication');


// Route for updating own details
Route::post('/admin/update-details',                  [AdminController::class, 'updateOwnDetails'])    ->name('updateOwnDetails');


// Route for updating own details
Route::post('/staff/update-details',                  [StaffController::class, 'updateOwnDetails2'])   ->name('updateOwnDetails2');


// Route for updating own details
Route::post('/officer/update-details',                [OfficerController::class, 'updateOwnDetails3']) ->name('updateOwnDetails3');

Route::post('/staff/mc-application',                  [StaffController::class, 'storeMcApplication'])  ->name('staff.mc.submit');
Route::get('/staff',                                  [StaffController::class, 'index'])               ->name('staff');
Route::delete('/staff/mc-application/{id}',           [StaffController::class, 'deleteMC'])            ->name('staff.deleteMC');
Route::post('/staff/mc-application/edit/{id}',        [StaffController::class, 'editMC'])              ->name('staff.mc.edit');

Route::get('/officer',                                [OfficerController::class, 'index'])             ->name('officer');
Route::post('/officer/update-status/{id}',            [OfficerController::class, 'updateStatus'])      ->name('officer.updateStatus');


// Officer approval route
Route::post('/mc-applications/{id}/officer-approve',  [OfficerController::class, 'approve'])           ->name('officer.approve');


// Admin approval route
Route::post('/mc-applications/{id}/admin-approve',    [AdminController::class, 'approve'])             ->name('admin.approve');

Route::post('/mc-applications/{id}/admin-reject',     [AdminController::class, 'reject'])              ->name('admin.reject');


// Route for submitting MC application
Route::post('/staff/mc-application',                  [StaffController::class, 'storeMcApplication'])  ->name('staff.mc.submit');

Route::post('/admin/approve/{id}',                    [AdminController::class, 'approve'])             ->name('admin.approve');






