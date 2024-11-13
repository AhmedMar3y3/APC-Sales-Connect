<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Medication;
use App\Models\Pharmacy;
use App\Models\LeaderCode;
use App\Models\Supervisor;
use App\Models\User;

class StatisticsController extends Controller
{
    public function index()
    {
        $supervisorIds = Supervisor::where('leader_id', auth('leader')->id())->pluck('id');
        $representatives = User::whereIn('supervisor_id', $supervisorIds)->count();
        $supervisors = Supervisor::where('leader_id', auth('leader')->id())->count();
        $totalDoctors = Doctor::all()->count();
        $totalPharmacies = Pharmacy::all()->count();
        $totalMedications = Medication::all()->count();
        $code = LeaderCode::where('leader_id', auth('leader')->id())->pluck('code')->first();

        return view('Leader.dashboard',compact('representatives','totalDoctors','totalPharmacies','totalMedications','code','supervisors'));
    }
}
