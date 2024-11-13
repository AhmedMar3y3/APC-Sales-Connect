<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index(Request $request)
{
    $search = $request->query('search');

    $medications = Medication::where('name', 'LIKE', "%{$search}%")
                            ->get();

    return view('Admin.medications.index', compact('medications'));
}

    public function create()
    {
        return view('Admin.medications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:medications,name',
        ]);
        Medication::create([
            'name' => $request->name,
        ]);
         return redirect()->route('admin.medications.index')->with('success', 'Medication added successfully!');
    }
    public function destroy($id)
{
    $medications = Medication::findOrFail($id);
    $medications->delete();

    return redirect()->route('admin.medications.index')->with('success', 'Medication deleted successfully!');
}
}
