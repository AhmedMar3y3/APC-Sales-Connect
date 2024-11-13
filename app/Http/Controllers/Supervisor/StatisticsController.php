<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Medication;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Models\SupervisorCode;
use App\Models\User;

class StatisticsController extends Controller
{
    public function index()
    {
        $representatives = User::where('supervisor_id', auth('supervisor')->id())->count();
        $totalDoctors = Doctor::all()->count();
        $totalPharmacies = Pharmacy::all()->count();
        $totalMedications = Medication::all()->count();
        $code = SupervisorCode::where('supervisor_id', auth('supervisor')->id())->pluck('code')->first();

        return view('Supervisor.dashboard',compact('representatives','totalDoctors','totalPharmacies','totalMedications','code'));
    }
}
