<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pharmacy;
use App\Models\Doctor;
use App\Models\Medication;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
        $totalPharmacies = Pharmacy::count();
        $totalDoctors = Doctor::count();
        $totalMedications = Medication::count();
        $totalScientific = User::where('role', 'علمي')->count();
        $totalCommercial = User::where('role', 'تجاري')->count();
        $newUsersLast7Days = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('created_at', '>=', Carbon::today()->subDays(6))
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('count', 'date')
        ->toArray();

    $last7Days = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::today()->subDays($i)->toDateString();
        $last7Days[$date] = $newUsersLast7Days[$date] ?? 0;
    }
        return view('Admin.dashboard', compact('totalUsers', 'totalPharmacies', 'totalDoctors', 'totalMedications', 'totalScientific', 'totalCommercial', 'last7Days', 'newUsersToday'));
    }
}
