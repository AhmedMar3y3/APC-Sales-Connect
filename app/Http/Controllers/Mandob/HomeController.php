<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Notifications\DailyTarget;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function pendingVisitsPerDay(){
        $visits = Visit::where('representative_id', auth()->user()->id)
            ->where('status', 'قيد الأنتظار')
            ->whereDate('date', now())
            ->count();
            return response()->json('عدد الزيارات القيد الانتظار اليوم هو ' . $visits);
    }
    
    public function completedVisits()
    {
        $monthYear = explode('-', $this->month);
        $month = $monthYear[1];
        $year = $monthYear[0];
    
        return $this->representative->visits()
            ->where('status', 'أكتملت')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count();
    }
    

    public function PercentagePerDay()
{
    $today = Carbon::today();

    // Filter visits for the authenticated user and today's date
    $totalVisits = Visit::where('representative_id', auth()->user()->id)
                        ->whereDate('date', $today)
                        ->count();

    $completedVisits = Visit::where('representative_id', auth()->user()->id)
                            ->whereDate('date', $today)
                            ->where('status', 'أكتملت')
                            ->count();

    $percentage = $totalVisits > 0 ? ($completedVisits / $totalVisits) * 100 : 0;
    // if ($percentage == 100) {
    //     auth()->user()->notify(new DailyTarget());
    // }

    return response()->json(round($percentage));
}

    public function showMonthlyTarget()
{
    $representative = auth()->user();
    $currentMonth = now()->format('Y-m');

    $target = $representative->monthlyTargets()->where('month', $currentMonth)->first();

    if (!$target) {
        return response()->json('No target set for this month.');
    }

    $completedVisits = $representative->visits()
        ->where('status', 'أكتملت')
        ->whereMonth('date', now())
        ->count();

    $percentage = ($completedVisits / $target->target) * 100;

    return response()->json([
        'monthly_target' => $target->target,
        'completed_visits' => $completedVisits,
        'percentage' => round($percentage, 2) . '%',
    ]);
}

}
