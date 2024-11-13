<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Http\Requests\storePharmacyRequest;
use App\Http\Requests\updatePharmacyRequest;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
            $search = $request->query('search');       
            $pharmacies = Pharmacy::where('name', 'LIKE', "%{$search}%")
            ->get();
    
        return view('Leader.pharmacies.index', compact('pharmacies'));
    }
    public function show(string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        return view('Leader.pharmacies.show', compact('pharmacy'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Leader.pharmacies.create');
    }

    public function store(storePharmacyRequest $request)
    {
       

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/pharmacies', 'public');
        }
        $pharmacy = Pharmacy::create($validated);

        return redirect()->route('leader.pharmacies.index', compact('pharmacy'))->with('success', 'Pharmacy created successfully');
    }
    public function edit(string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        return view('Leader.pharmacies.edit', compact('pharmacy'));
    }

    public function update(UpdatePharmacyRequest $request, string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);

        $validated = $request->validated();
        $updateData = [];
        
        if ($request->hasFile('image')) {
            $updateData['image'] = $request->file('image')->store('images/pharmacies', 'public');
        }
            foreach (['name', 'details', 'phone', 'address'] as $field) {
            if (array_key_exists($field, $validated)) {
                $updateData[$field] = $validated[$field];
            }
        }
        $pharmacy->update($updateData);
        return redirect()->route('leader.pharmacies.index')->with('success', 'Pharmacy updated successfully.');
    }


    public function destroy(string $id)
    {
        $pharmacy = Pharmacy::with('notes.user')->findOrFail($id);
        $pharmacy->delete();
        return redirect()->route('leader.pharmacies.index')->with('success', 'Pharmacy deleted successfully.');
    }
}
