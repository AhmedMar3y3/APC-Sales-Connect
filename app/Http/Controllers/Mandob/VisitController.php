<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeVisitRequest;
use App\Http\Requests\updateVisitRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use Carbon\Carbon;
use App\Notifications\CreateVisit;

class VisitController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $visits = Visit::with(['representative', 'doctor', 'pharmacy', 'medication'])
                        ->where('representative_id', $user->id)
                        ->whereDate('date', Carbon::today()) 
                        ->get();

        return response()->json([
            'message' => 'Visits retrieved successfully.',
            'visits' => $visits,
        ], 200);
    }

    public function store(storeVisitRequest $request)
    {
        $representative = Auth::user();

        if ($representative->role === 'علمي') {
            if (!$request->doctor_id && !$request->pharmacy_id) {
                return response()->json(['error' => 'Scientific representatives must visit a doctor, a pharmacy, or both.'], 400);
            }
        } elseif ($representative->role === 'تجاري') {
            if (!$request->pharmacy_id || $request->doctor_id) {
                return response()->json(['error' => 'Commercial representatives can only visit pharmacies.'], 400);
            }
        }

        $visit = Visit::create([
            'representative_id' => $representative->id,
            'doctor_id' => $request->doctor_id,
            'pharmacy_id' => $request->pharmacy_id,
            'medication_id' => $request->medication_id,
            'date' => Carbon::today()->toDateString(), 
            'time' => $request->time,
            'notes' => $request->notes,
            'status' => $request->status ?? 'قيد الأنتظار',
        ]);
        $user = Auth::user();
        $user->notify(new CreateVisit( ));

        return response()->json([
            'message' => 'Visit created successfully.',
            'visit' => $visit,
        ], 201);
    }


    public function show($id)
    {
        $user = Auth::user();
        $visit = Visit::with(['representative', 'doctor', 'pharmacy', 'medication'])
                      ->where('representative_id', $user->id)
                      ->find($id);

        if (!$visit) {
            return response()->json(['error' => 'Visit not found.'], 404);
        }

        return response()->json([
            'message' => 'Visit retrieved successfully.',
            'visit' => $visit,
        ], 200);
    }

    public function update(updateVisitRequest $request, $id)
    {
        $user = Auth::user();
        $visit = Visit::where('representative_id', $user->id)->find($id);

        if (!$visit) {
            return response()->json(['error' => 'Visit not found or you do not have permission to update this visit.'], 404);
        }

        $visit->update($request->only('date', 'time', 'medication_id', 'doctor_id', 'pharmacy_id', 'notes', 'status'));

        return response()->json([
            'message' => 'Visit updated successfully.',
            'visit' => $visit,
        ], 200);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $visit = Visit::where('representative_id', $user->id)->find($id);

        if (!$visit) {
            return response()->json(['error' => 'Visit not found.'], 404);
        }

        $visit->delete();

        return response()->json([
            'message' => 'Visit deleted successfully.',
        ], 200);
    }
}
