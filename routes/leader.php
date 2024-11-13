<?php

use App\Http\Controllers\Leader\DoctorController;
use App\Http\Controllers\Leader\LeaderAuthController;
use App\Http\Controllers\Leader\MedicationController;
use App\Http\Controllers\Leader\PharmacyController;
use App\Http\Controllers\Leader\RepresentativeController;
use App\Http\Controllers\Leader\StatisticsController;
use App\Http\Controllers\Leader\SupervisorController;
use App\Http\Controllers\Leader\TargetController;
use App\Http\Controllers\Leader\VisitController;
use Illuminate\Support\Facades\Route;


//////////////////////////////////Leader Routes//////////////////////////////////

//public routes
Route::get('/', [LeaderAuthController::class, 'loadLoginPage'])->name('leader.loginPage');
route::post('/login', [LeaderAuthController::class, 'loginUser'])->name('leader.loginUser');

//protected routes
Route::middleware(['auth.leader'])->group(function () {
    Route::get('/dashboard', [StatisticsController::class, 'index'])->name('leader.dashboard');
    Route::get('/supervisor', [SupervisorController::class, 'index'])->name('leader.supervisor');
    Route::get('supervisors/{supervisorId}/representatives', [SupervisorController::class, 'viewRepresentatives'])->name('leader.supervisor.viewRepresentatives');
    Route::post('/logout', [LeaderAuthController::class, 'logout'])->name('leader.logout'); 
    
 //Pharmacy routes
 Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('leader.pharmacies.index');
 Route::get('/pharmacies/create', [PharmacyController::class, 'create'])->name('leader.pharmacies.create');
 Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('leader.pharmacies.store');
 Route::get('/pharmacies/{id}/edit', [PharmacyController::class, 'edit'])->name('leader.pharmacies.edit');
 Route::put('/pharmacies/{id}', [PharmacyController::class, 'update'])->name('leader.pharmacies.update');
 Route::delete('/pharmacies/{id}', [PharmacyController::class, 'destroy'])->name('leader.pharmacies.destroy');
 Route::get('/pharmacies/{pharmacy}', [PharmacyController::class, 'show'])->name('leader.pharmacies.show');


//Doctor routes
   Route::get('/doctors', [DoctorController::class, 'index'])->name('leader.doctors.index');
   Route::get('/doctors/create', [DoctorController::class, 'create'])->name('leader.doctors.create');
   Route::post('/doctors', [DoctorController::class, 'store'])->name('leader.doctors.store');
   Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('leader.doctors.edit');
   Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('leader.doctors.update');
   Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('leader.doctors.destroy');   
   Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('leader.doctors.show');
//Medication routes
   Route::get('/medics', [MedicationController::class, 'index'])->name('leader.medications.index');
   Route::get('/medics/create', [MedicationController::class, 'create'])->name('leader.medications.create');
   Route::post('/medics', [MedicationController::class, 'store'])->name('leader.medications.store');
   Route::delete('/medics/{doctor}', [MedicationController::class, 'destroy'])->name('leader.medications.destroy');  
   Route::get('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'showVisit'])->name('leader.representatives.visits');
   Route::post('representatives/{representativeId}/visits', [VisitController::class, 'store'])->name('leader.representatives.visits.store');
   Route::get('representatives/{representativeId}/visits/{visitId}/edit', [VisitController::class, 'edit'])->name('leader.representatives.visits.edit');
   Route::put('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'update'])->name('leader.representatives.visits.update');
   Route::delete('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'destroy'])->name('leader.representatives.visits.destroy');

   //target routes
   Route::get('representatives/{id}/create-target', [TargetController::class, 'createTarget'])->name('leader.target.create');
   Route::post('representatives/{id}/store-target', [TargetController::class, 'storeTarget'])->name('leader.target.store');
   Route::get('representatives/{id}/targets', [TargetController::class, 'viewTargets'])->name('leader.target.view');
   Route::get('representatives/{representativeId}/targets/{targetId}/edit', [TargetController::class, 'editTarget'])->name('leader.target.edit');
   Route::put('representatives/{representativeId}/targets/{targetId}', [TargetController::class, 'updateTarget'])->name('leader.target.update');
   Route::delete('representatives/{representativeId}/targets/{targetId}', [TargetController::class, 'deleteTarget'])->name('leader.target.delete');
    //representative routes
    Route::get('representatives/', [RepresentativeController::class, 'index'])->name('leader.representatives.index');
    Route::get('representatives/{id}', [RepresentativeController::class, 'show'])->name('leader.representatives.show');      
    Route::get('representatives/{representativeId}/visits/create', [VisitController::class, 'create'])->name('leader.representatives.visitCreate');
});