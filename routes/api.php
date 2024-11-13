<?php

use App\Http\Controllers\Leader\LeaderAuthController;
use App\Http\Controllers\Mandob\AddNotesController;
use App\Http\Controllers\Mandob\BonusController;
use App\Http\Controllers\Mandob\DoctorProfileController;
use App\Http\Controllers\Mandob\GettingController;
use App\Http\Controllers\Mandob\HomeController;
use App\Http\Controllers\Mandob\PharmacyProfileController;
use App\Http\Controllers\Mandob\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mandob\UserAuthController;
use App\Http\Controllers\Mandob\VisitController;
use App\Http\Controllers\Mandob\ReportController;
use App\Http\Controllers\Mandob\VisitManipulationController;
use App\Http\Controllers\Mandob\NotesController;
use App\Http\Controllers\Mandob\LocationController;
use App\Http\Controllers\Mandob\NotificationController;
use App\Http\Controllers\Supervisor\AuthController;

//////////////////////////  Admin Public Routes  //////////////////////////
Route::post('/admin/register', [App\Http\Controllers\Admin\AuthController::class, 'register']);
Route::post('/leader/register', [LeaderAuthController::class, 'register']);
Route::post('/supervisor/register', [AuthController::class, 'register']);

//////////////////////////  User Public Routes  //////////////////////////
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/verify-email', [UserAuthController::class, 'verifyEmail']);
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/forgot-password', [UserAuthController::class, 'forgotPassword']);
Route::post('/reset-password', [UserAuthController::class, 'resetPassword']);

//////////////////////////  User Private Routes  //////////////////////////
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [UserAuthController::class, 'logout']);
    //prfile routes
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::post('/profile-update', [ProfileController::class, 'updateProfile']);
    // Route::get('/all-visits', [ProfileController::class, 'allVisits']);
    // Route::get('/completed-visits', [ProfileController::class, 'completedVisits']);
    // Route::get('/pending-visits', [ProfileController::class, 'pendingVisits']);
    // Route::get('/most-sold-medication', [ProfileController::class, 'getMostSoldMedication']);
    Route::get('/profile-statistics', [ProfileController::class, 'profileStats']);

    //Home routes
    Route::get('/completed-visits-per-day', [HomeController::class, 'completedVisits']);
    Route::get('/percentage-per-day', [HomeController::class, 'PercentagePerDay']);
    Route::get('/monthly-target', [HomeController::class, 'showMonthlyTarget']);

    //visit routes
    Route::resource('/visits', VisitController::class);
    Route::get('/doctors', [GettingController::class, 'getAllDoctors']);
    Route::get('/pharmacies', [GettingController::class, 'getAllPharmacies']);
    Route::get('/medications', [GettingController::class, 'getAllMedications']);
    //visit manipulation routes
    Route::post('/visits/{id}/start', [VisitManipulationController::class, 'startVisit']);
    Route::post('/visits/{id}/end', [VisitManipulationController::class, 'endVisit']);
    
//doctor profile
Route::get('/doctor-profile/{id}', [DoctorProfileController::class, 'doctorProfile']);
//pharmacy profile
Route::get('/pharmacy-profile/{id}', [PharmacyProfileController::class, 'pharmacyProfile']);
//report routes
Route::get('/reports', [ReportController::class, 'index']);
Route::get('/reports/InBetween', [ReportController::class, 'getBetween']);

//note routes
Route::post('/notes', [AddNotesController::class, 'store']);

//bonus routes
Route::get('/points', [BonusController::class, 'getTotalPoints']);

//location routes

Route::post('/doctors/{id}/location', [LocationController::class, 'storeDoctorLocation']);
Route::post('/pharmacies/{id}/location', [LocationController::class, 'storePharmacyLocation']);
Route::get('/doctors/{id}/location', [LocationController::class, 'getDoctorLocation']);
Route::get('/pharmacies/{id}/location', [LocationController::class, 'getPharmacyLocation']);

//notification routes
Route::get('/notifications', [NotificationController::class, 'index']);












});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

