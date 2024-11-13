<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $reports = Visit::with(['representative', 'doctor', 'pharmacy', 'medication'])
            ->where('representative_id', $user->id)
            ->when($request->date, function($query, $date) {
                $query->whereDate('date', $date);
            })->when($request->is_sold, function($query, $is_sold) {
                $query->where('is_sold', $is_sold);
            })->get()->map(function ($visit) {
                return [
                    'doctor or pharmacy name' => $visit->doctor->name ?? $visit->pharmacy->name,
                    'address' => $visit->doctor->address ?? $visit->pharmacy->address,
                    'date' => $visit->date,
                    'time' => $visit->time,
                    'medication name' => $visit->medication->name ?? null,
                    'notes' => $visit->notes,
                    'rating' => $visit->rating,
                ];
            });
    
        return response()->json([
            'message' => 'Reports retrieved successfully.',
            'reports' => $reports,
        ], 200);
    }
    
    public function getBetween(Request $request)
{
    $user = Auth::user();

    $reports = Visit::with(['representative', 'doctor', 'pharmacy', 'medication'])
        ->where('representative_id', $user->id);

    if ($request->date) {
        $reports->whereDate('date', $request->date);
    }

    if ($request->is_sold) {
        $reports->where('is_sold', $request->is_sold);
    }

    if ($request->from_date && $request->to_date) {
        $reports->whereBetween('date', [$request->from_date, $request->to_date]);
    }

    $reports = $reports->get()->map(function ($visit) {
        return [
            'doctor or pharmacy name' => $visit->doctor->name ?? $visit->pharmacy->name,
                    'address' => $visit->doctor->address ?? $visit->pharmacy->address,
                    'date' => $visit->date,
                    'time' => $visit->time,
                    'medication name' => $visit->medication->name ?? null,
                    'notes' => $visit->notes,
                    'rating' => $visit->rating,
        ];
    });

    return response()->json([
        'message' => 'Reports retrieved successfully.',
        'reports' => $reports,
    ], 200);
}

}
