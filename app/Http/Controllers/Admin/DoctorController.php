<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Http\Requests\storeDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $doctors = Doctor::where('name', 'LIKE', "%{$search}%")
        ->get();
    
        return view('Admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('Admin.doctors.create');
    }

    public function store(storeDoctorRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/doctors', 'public');
        }
        $doctor = Doctor::create($validated);
        return redirect()->route('admin.doctors.index', compact('doctor'))->with('success', 'Doctor created successfully');
    }

    public function show($id)
    {
        $doctor = Doctor::with('notes.user')->findOrFail($id); 
        return view('Admin.doctors.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('Admin.doctors.edit', compact('doctor'));
    }

    public function update(updateDoctorRequest $request, $id)
    {
        $doctor = Doctor::findOrFail($id);    
        $validated = $request->validated();
        $updateData = [];
        
        if ($request->hasFile('image')) {
            $updateData['image'] = $request->file('image')->store('images/doctors', 'public');
        }
            foreach (['name', 'specialization', 'details', 'phone', 'address'] as $field) {
            if (array_key_exists($field, $validated)) {
                $updateData[$field] = $validated[$field];
            }
        }
        $doctor->update($updateData);
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully');
    }
    
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        if (auth('admin')->check()) {
            $doctor->delete();
            return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully');
        } else {
            abort(403, 'Unauthorized');
        }
        }
    }
