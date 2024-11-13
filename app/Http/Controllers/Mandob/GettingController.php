<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Medication;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Auth;

class GettingController extends Controller
{
    
    public function getAllDoctors(){
        if (Auth::user()->role === 'تجاري') {
            return response()->json(['error' => 'Commercial representatives cannot access this resource.'], 403);
        }
        else{ $doctors = Doctor::all();
            return response()->json([
                'message' => 'Doctors retrieved successfully.',
                'doctors' => $doctors,
            ], 200);}  
    }
    public function getAllMedications(){
        $medications = Medication::all();
        return response()->json([
            'message' => 'Midications retrieved successfully.',
            'medications' => $medications,
        ], 200);
    }
    public function getAllPharmacies(){
        $pharmacies = Pharmacy::all();
        return response()->json([
            'message' => 'pharmacies retrieved successfully.',
            'pharmacies' => $pharmacies,
        ], 200);
    }
}
