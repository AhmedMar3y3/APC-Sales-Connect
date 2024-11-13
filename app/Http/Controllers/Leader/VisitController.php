<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pharmacy;
use App\Models\Medication;
use App\Models\Doctor;
use App\Models\Visit;
use App\Http\Requests\storeVisitRequest;
use App\Http\Requests\updateVisitRequest;

class VisitController extends Controller
{
    public function showVisit($representativeId, $visitId)
    {
        $representative = User::with(['visits' => function($query) use ($visitId) {
            $query->where('id', $visitId);
        }, 'visits.doctor', 'visits.pharmacy', 'visits.medication'])->find($representativeId);

        if (!$representative || !$representative->visits->first()) {
            return redirect()->route('leader.representatives.index')->with('error', 'Visit not found');
        }

        $visit = $representative->visits->first();

        return view('Leader.representatives.visits', compact('representative', 'visit'));
    }
    public function create($representativeId)
    {
        $representative = User::findOrFail($representativeId);
        $medications = Medication::all();
        $pharmacies = Pharmacy::all();
        $doctors = Doctor::all();
        return view('Leader.representatives.createVisit', compact('representative', 'medications', 'pharmacies', 'doctors'));
    }

    public function store(storeVisitRequest $request, $representativeId)
    {
        $representative = User::findOrFail($representativeId);
    
        if ($representative->role === 'علمي') {
            if (!$request->doctor_id && !$request->pharmacy_id) {
                return back()->withErrors(['error' => 'Scientific representatives must visit a doctor, a pharmacy, or both.']);
            }
        } elseif ($representative->role === 'تجاري') {
            if (!$request->pharmacy_id || $request->doctor_id) {
                return back()->withErrors(['error' => 'Commercial representatives can only visit pharmacies.']);
            }
        }
    
        Visit::create([
            'representative_id' => $representativeId,
            'doctor_id' => $request->doctor_id,
            'pharmacy_id' => $request->pharmacy_id,
            'medication_id' => $request->medication_id,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);
    
        return redirect()->route('leader.representatives.show', $representativeId)
            ->with('success', 'Visit added successfully.');
    }
    

    public function edit($representativeId, $visitId)
    {
        $representative = User::findOrFail($representativeId);
        $visit = Visit::findOrFail($visitId);
        
        $medications = Medication::all();
    
        return view('Leader.representatives.editVisit', compact('representative', 'visit', 'medications'));
    }
    

    public function update(updateVisitRequest $request, $representativeId, $visitId)
{
    $visit = Visit::findOrFail($visitId);
    $validated = $request->validated();
    $updateData = [];
    foreach (['date', 'time', 'medication_id', 'doctor_id', 'pharmacy_id', 'notes', 'status'] as $field) {
        if (array_key_exists($field, $validated)) {
            $updateData[$field] = $validated[$field];
        }
    }

    $visit->update($updateData);

    return redirect()->route('leader.representatives.show', $representativeId)
        ->with('success', 'Visit updated successfully.');
}


    
    public function destroy($representativeId, $visitId)
    {
        $visit = Visit::findOrFail($visitId);
        $visit->delete();

        return redirect()->route('leader.representatives.show', $representativeId)
            ->with('success', 'Visit deleted successfully.');
    }
}
