<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BonusController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\MedicationController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RepresentativeController;
use App\Http\Controllers\Admin\TargetController;
use App\Http\Controllers\Admin\VisitController;


//////////////////////////////////Admin Routes//////////////////////////////////

//public routes
Route::get('/', [AuthController::class, 'loadLoginPage'])->name('loginPage');
Route::post('/login/admin', [AuthController::class, 'loginUser'])->name('loginUser');

//protected routes
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/dashboard', [StatisticsController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 

 //Pharmacy routes
    Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('admin.pharmacies.index');
    Route::get('/pharmacies/create', [PharmacyController::class, 'create'])->name('admin.pharmacies.create');
    Route::post('/pharmacies', [PharmacyController::class, 'store'])->name('admin.pharmacies.store');
    Route::get('/pharmacies/{id}/edit', [PharmacyController::class, 'edit'])->name('admin.pharmacies.edit');
    Route::put('/pharmacies/{id}', [PharmacyController::class, 'update'])->name('admin.pharmacies.update');
    Route::delete('/pharmacies/{id}', [PharmacyController::class, 'destroy'])->name('admin.pharmacies.destroy');
    Route::get('/pharmacies/{pharmacy}', [PharmacyController::class, 'show'])->name('admin.pharmacies.show');


  //Doctor routes
      Route::get('/docs', [DoctorController::class, 'index'])->name('admin.doctors.index');
      Route::get('/docs/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
      Route::post('/docs', [DoctorController::class, 'store'])->name('admin.doctors.store');
      Route::get('/docs/{doctor}/edit', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
      Route::put('/docs/{doctor}', [DoctorController::class, 'update'])->name('admin.doctors.update');
      Route::delete('/docs/{doctor}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');   
      Route::get('/docs/{doctor}', [DoctorController::class, 'show'])->name('admin.doctors.show');
  //Medication routes
      Route::get('/medics', [MedicationController::class, 'index'])->name('admin.medications.index');
      Route::get('/medics/create', [MedicationController::class, 'create'])->name('admin.medications.create');
      Route::post('/medics', [MedicationController::class, 'store'])->name('admin.medications.store');
      Route::delete('/medics/{doctor}', [MedicationController::class, 'destroy'])->name('admin.medications.destroy');  
      
      //representative routes
      Route::get('representatives', [RepresentativeController::class, 'index'])->name('admin.representatives.index');
      Route::get('representatives/{id}', [RepresentativeController::class, 'show'])->name('admin.representatives.show');      
      Route::get('representatives/{representativeId}/visits/create', [VisitController::class, 'create'])->name('admin.representatives.visitCreate');

      //leaders routes
      Route::get('/leaders', [LeaderController::class, 'viewLeaders'])->name('admin.leaders.index');
      Route::get('/leaders/{leaderId}/supervisors', [LeaderController::class, 'viewSupervisors'])->name('admin.leaders.supervisors');
      Route::get('/leaders/supervisors/{supervisorId}/representatives', [LeaderController::class, 'viewRepresentatives'])->name('admin.leaders.supervisors.representatives');
      //visit routes
      Route::get('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'showVisit'])->name('admin.representatives.visits');
      Route::post('representatives/{representativeId}/visits', [VisitController::class, 'store'])->name('admin.representatives.visits.store');
      Route::get('representatives/{representativeId}/visits/{visitId}/edit', [VisitController::class, 'edit'])->name('admin.representatives.visits.edit');
      Route::put('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'update'])->name('admin.representatives.visits.update');
      Route::delete('representatives/{representativeId}/visits/{visitId}', [VisitController::class, 'destroy'])->name('admin.representatives.visits.destroy');

      //target routes
      Route::get('representatives/{id}/create-target', [TargetController::class, 'createTarget'])->name('admin.target.create');
      Route::post('representatives/{id}/store-target', [TargetController::class, 'storeTarget'])->name('admin.target.store');
      Route::get('representatives/{id}/targets', [TargetController::class, 'viewTargets'])->name('admin.target.view');
      Route::get('representatives/{representativeId}/targets/{targetId}/edit', [TargetController::class, 'editTarget'])->name('admin.target.edit');
      Route::put('representatives/{representativeId}/targets/{targetId}', [TargetController::class, 'updateTarget'])->name('admin.target.update');
      Route::delete('representatives/{representativeId}/targets/{targetId}', [TargetController::class, 'deleteTarget'])->name('admin.target.delete');

      //Bonus routes
        Route::get('/bonus', [BonusController::class, 'viewBonus'])->name('admin.bonus.index');
// Reports routes
Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
Route::get('/reports/view/{id}', [ReportController::class, 'viewMonthlyReports'])->name('admin.reports.show');
Route::get('admin/view/{id}/download', [ReportController::class, 'downloadMonthlyReportPdf'])->name('admin.reports.download');


});