<?php

namespace App\Http\Controllers\Mandob;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;

class BonusController extends Controller
{
    public function getTotalPoints()
    {
        $user = Auth::user();

        $totalPoints = Visit::where('representative_id', $user->id)->sum('points');  
              return response()->json([
            'total_points' => $totalPoints,

        ], 200);
    
    }
}
