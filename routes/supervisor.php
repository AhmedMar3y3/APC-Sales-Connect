<?php

use App\Http\Controllers\Supervisor\AuthController;
use App\Http\Controllers\Supervisor\DoctorController;
use App\Http\Controllers\Supervisor\MedicationController;
use App\Http\Controllers\Supervisor\PharmacyController;
use App\Http\Controllers\Supervisor\RepresentativeController;
use App\Http\Controllers\Supervisor\StatisticsController;
use App\Http\Controllers\Supervisor\TargetController;
use App\Http\Controllers\Supervisor\VisitController;
use Illuminate\Support\Facades\Route;


//////////////////////////////////Supervisor Routes//////////////////////////////////

//public routes
Route::get('/register/form', [AuthController::class, 'loadRegisterForm'])->name('supervisor.registerform');
Route::post('/register/user', [AuthController::class, 'register'])->name('supervisor.registerUser');
Route::get('/', [AuthController::class, 'loadLoginPage'])->name('supervisor.loginPage');
route::post('/login', [AuthController::class, 'loginUser'])->name('supervisor.loginUser');
Route::get('supervisor/forgot-password', [AuthController::class, 'loadForgotPasswordForm'])->name('supervisor.forgotPasswordForm');
Route::post('supervisor/forgot-password', [AuthController::class, 'forgotPassword'])->name('supervisor.forgotPassword');

Route::get('supervisor/reset-password', [AuthController::class, 'loadResetPasswordForm'])->name('supervisor.resetPasswordForm');
Route::post('supervisor/reset-password', [AuthController::class, 'resetPassword'])->name('supervisor.resetPassword');


//protected routes
Route::middleware(['auth.supervisor'])->group(function () {
    Route::get('/dashboard', [StatisticsController::class, 'index'])->name('supervisor.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('supervisor.logout'); 
     //Pharmacy routes
 Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('supervisor.pharmacies.index');
 Route::get('/pharmacies/create', [PharmacyController::class, 'create'])->name('supervisor.pharmacies.create');
 Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('supervisor.pharmacies.store');
 Route::get('/pharmacies/{id}/edit', [PharmacyController::class, 'edit'])->name('supervisor.pharmacies.edit');
 Route::put('/pharmacies/{id}', [PharmacyController::class, 'update'])->name('supervisor.pharmacies.update');
 Route::delete('/pharmacies/{id}', [PharmacyController::class, 'destroy'])->name('supervisor.pharmacies.destroy');
 Route::get('/pharmacies/{pharmacy}', [PharmacyController::class, 'show'])->name('supervisor.pharmacies.show');


//Doctor routes
   Route::get('/doctors', [DoctorController::class, 'index'])->name('supervisor.doctors.index');
   Route::get('/doctors/create', [DoctorController::class, 'create'])->name('supervisor.doctors.create');
   Route::post('/doctors', [DoctorController::class, 'store'])->name('supervisor.doctors.store');
   Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('supervisor.doctors.edit');
   Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('supervisor.doctors.update');
   Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('supervisor.doctors.destroy');   
   Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('supervisor.doctors.show');
//Medication routes
   Route::get('/medics', [MedicationController::class, 'index'])->name('supervisor.medications.index');
   Route::get('/medics/create', [MedicationController::class, 'create'])->name('supervisor.medications.create');
   Route::post('/medics', [MedicationController::class, 'store'])->name('supervisor.medications.store');
   Route::delete('/medics/{doctor}', [MedicationController::class, 'destroy'])->name('supervisor.medications.destroy');  
   Route::get('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'showVisit'])->name('supervisor.representatives.visits');
   Route::post('representatives/{representativeId}/visits', [VisitController::class, 'store'])->name('supervisor.representatives.visits.store');
   Route::get('representatives/{representativeId}/visits/{visitId}/edit', [VisitController::class, 'edit'])->name('supervisor.representatives.visits.edit');
   Route::put('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'update'])->name('supervisor.representatives.visits.update');
   Route::delete('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'destroy'])->name('supervisor.representatives.visits.destroy');

   //target routes
   Route::get('representatives/{id}/create-target', [TargetController::class, 'createTarget'])->name('supervisor.target.create');
   Route::post('representatives/{id}/store-target', [TargetController::class, 'storeTarget'])->name('supervisor.target.store');
   Route::get('representatives/{id}/targets', [TargetController::class, 'viewTargets'])->name('supervisor.target.view');
   Route::get('representatives/{representativeId}/targets/{targetId}/edit', [TargetController::class, 'editTarget'])->name('supervisor.target.edit');
   Route::put('representatives/{representativeId}/targets/{targetId}', [TargetController::class, 'updateTarget'])->name('supervisor.target.update');
   Route::delete('representatives/{representativeId}/targets/{targetId}', [TargetController::class, 'deleteTarget'])->name('supervisor.target.delete');
    //representative routes
    Route::get('representatives/', [RepresentativeController::class, 'index'])->name('supervisor.representatives.index');
    Route::get('representatives/{id}', [RepresentativeController::class, 'show'])->name('supervisor.representatives.show');      
    Route::get('representatives/{representativeId}/visits/create', [VisitController::class, 'create'])->name('supervisor.representatives.visitCreate');
});