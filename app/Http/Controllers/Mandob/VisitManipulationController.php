<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Mandob\NotificationController;
use App\Notifications\EndVisit;
use Carbon\Carbon;
use App\Notifications\Bonus;
use App\Notifications\TotalPointsPerDay;

class VisitManipulationController extends Controller
{
    public function startVisit($id)
    {
        $user = Auth::user();
        $visit = Visit::where('representative_id', $user->id)
                      ->where('id', $id)
                      ->where('status', 'قيد الأنتظار')
                      ->first();

        if (!$visit) {
            return response()->json(['error' => 'Visit not found or it has already been started.'], 404);
        }

        $visit->update(['status' => 'جارية']);

        return response()->json([
            'message' => 'Visit started successfully.',
        ], 200);
    }

    public function endVisit(Request $request, $id)
{
    $user = Auth::user();

    $visit = Visit::where('representative_id', $user->id)
                  ->where('id', $id)
                  ->where('status', 'جارية')
                  ->first();

    if (!$visit) {
        return response()->json(['error' => 'Visit not found or it has already been completed.'], 404);
    }

    $request->validate([
        'is_sold' => 'required|boolean',
        'rating' => 'nullable|integer|min:1|max:5',
    ]);

    $points = $request->input('is_sold') ? 6 : 1;

    $visit->update([
        'status' => 'أكتملت',
        'rating' => $request->input('rating'),
        'is_sold' => $request->input('is_sold'),
        'points' => $points,
    ]);

    $currentMonth = now()->format('Y-m');

    $monthlyPoints = $user->monthlyPoints()->where('month', $currentMonth)->first();
    if ($monthlyPoints) {
        $monthlyPoints->increment('points', $points);
    } else {
        $user->monthlyPoints()->create([
            'points' => $points,
            'month' => $currentMonth,
        ]);
    }

    $user->notify(new Bonus($points)); 
    $user->notify(new EndVisit());

    $today = Carbon::today();
    $pointsEarnedToday = Visit::where('representative_id', $user->id)
                               ->where('status', 'أكتملت')
                               ->whereDate('updated_at', $today)
                               ->sum('points');
    $user->notify(new TotalPointsPerDay($pointsEarnedToday));

    return response()->json([
        'message' => 'Visit ended successfully, points awarded.',
        'points_earned' => $points,
    ], 200);
}

    
    //  private function checkPointsMilestone($user, $totalPoints)
    // {
     //     $milestones = [100, 200, 300];
        
     //     if (in_array($totalPoints, $milestones)) {
     //         $notificationController = new NotificationController();
    //         $notificationController->checkPoints($user);
    //     }
    // }
}

