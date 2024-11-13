<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medication;

class MedicationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
    
        $medications = Medication::where('name', 'LIKE', "%{$search}%")
                                ->get();
    
        return view('Leader.medications.index', compact('medications'));
    }
    
        public function create()
        {
            return view('Leader.medications.create');
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|unique:medications,name',
            ]);
            Medication::create([
                'name' => $request->name,
            ]);
             return redirect()->route('leader.medications.index')->with('success', 'Medication added successfully!');
        }
        public function destroy($id)
    {
        $medications = Medication::findOrFail($id);
        $medications->delete();
    
        return redirect()->route('leader.medications.index')->with('success', 'Medication deleted successfully!');
    }
}
