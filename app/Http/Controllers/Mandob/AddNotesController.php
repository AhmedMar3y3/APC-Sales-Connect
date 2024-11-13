<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class AddNotesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|string',
            'doctor_id' => 'nullable|exists:doctors,id',
            'pharmacy_id' => 'nullable|exists:pharmacies,id',
        ]);

        $note = Note::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'pharmacy_id' => $request->pharmacy_id,
            'note' => $request->note,
        ]);

        return response()->json([
            'message' => 'Note added successfully',
            'note' => $note,
        ]);
    }
}
