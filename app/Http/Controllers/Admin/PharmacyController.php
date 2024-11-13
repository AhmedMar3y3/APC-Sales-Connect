<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\storePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;


class PharmacyController extends Controller
{
    public function index(Request $request)
    {
            $search = $request->query('search');       
            $pharmacies = Pharmacy::where('name', 'LIKE', "%{$search}%")
            ->get();
    
        return view('Admin.pharmacies.index', compact('pharmacies'));
    }
    public function show(string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        return view('Admin.pharmacies.show', compact('pharmacy'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pharmacies.create');
    }

    public function store(storePharmacyRequest $request)
    {
       

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/pharmacies', 'public');
        }
        $pharmacy = Pharmacy::create($validated);

        return redirect()->route('admin.pharmacies.index', compact('pharmacy'))->with('success', 'Pharmacy created successfully');
    }
    public function edit(string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        return view('Admin.pharmacies.edit', compact('pharmacy'));
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
        return redirect()->route('admin.pharmacies.index')->with('success', 'Pharmacy updated successfully.');
    }


    public function destroy(string $id)
    {
        $pharmacy = Pharmacy::with('notes.user')->findOrFail($id);
        $pharmacy->delete();
        return redirect()->route('admin.pharmacies.index')->with('success', 'Pharmacy deleted successfully.');
    }
}
