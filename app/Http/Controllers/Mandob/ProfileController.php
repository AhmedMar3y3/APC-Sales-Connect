<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $updateData = [];

        if ($request->has('name')) {
            $updateData['name'] = $request->input('name');
        }

        if ($request->hasFile('image')) {
            $updateData['image'] = $request->file('image')->store('images/users', 'public');
        }
        $user->update($updateData);
        return response()->json(['user' => $user, 'message' => 'Profile updated successfully'], 200);
    }
//     public function allVisits()
//     {
//         $user = Auth::user();
//         $visits = $user->visits()->count();
//         return response()->json(['visits'   => $visits], 200);
//     }
//     public function completedVisits()
//     {
//         $user = Auth::user();
//         $visits = $user->visits()->where('status', 'أكتملت')->count();
//         return response()->json(['visits'   => $visits], 200);
//     }
//     public function pendingVisits()
//     {
//         $user = Auth::user();
//         $visits = $user->visits()->where('status', 'قيد الأنتظار')->count();
//         return response()->json(['visits'   => $visits], 200);
//     }
//     public function getMostSoldMedication()
// {
//     $user = Auth::user();
    
//     $mostSoldMedication = Visit::select('medication_id',
//      DB::raw('COUNT(*) as total_sold'))
//         ->where('representative_id', $user->id)
//         ->where('is_sold', true)
//         ->groupBy('medication_id')
//         ->orderByDesc('total_sold')
//         ->with('medication')
//         ->first();
//         $medication = $mostSoldMedication->medication->name;

//     if (!$mostSoldMedication) {
//         return response()->json(['error' => 'No sales found for this representative.'], 404);
//     }

//     return response()->json([
//         'message' => 'Most sold medication retrieved successfully.',
//         'medication' => $medication,
//         'total_sold' => $mostSoldMedication->total_sold,
//     ], 200);
// }
public function profileStats(){
    $user = Auth::user();
    $visits = $user->visits()->count();
    $CompletedVisits = $user->visits()->where('status', 'أكتملت')->count();
    $PendingVisits = $user->visits()->where('status', 'قيد الأنتظار')->count();
$mostSoldMedication = Visit::select('medication_id',
    DB::raw('COUNT(*) as total_sold'))
       ->where('representative_id', $user->id)
       ->where('is_sold', true)
       ->groupBy('medication_id')
       ->orderByDesc('total_sold')
       ->with('medication')
       ->first();
       $medication = $mostSoldMedication->medication->name;

   if (!$mostSoldMedication) {
       return response()->json(['error' => 'No sales found for this representative.'], 404);
   }
return response()->json([
    'message' => 'Successfully retrieved profile statistics',
    'All Visits' => $visits,
    'Completed Visits' =>$CompletedVisits,
    'Pending Visits' => $PendingVisits,
    'Most Sold Medication' => $medication,
    'Total Sold' =>$mostSoldMedication->total_sold
]);

}

}
