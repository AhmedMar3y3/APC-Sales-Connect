<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Pharmacy;

class LocationController extends Controller
{
    public function storeDoctorLocation(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        if (!is_null($doctor->latitude) && !is_null($doctor->longitude)) {
            return response()->json([
                'message' => 'Location already exists and cannot be updated',
            ], 403);
        }

        $doctor->latitude = $request->latitude;
        $doctor->longitude = $request->longitude;
        $doctor->save();

        return response()->json([
            'message' => 'Doctor location saved successfully',
            'doctor' => $doctor,
        ]);
    }

    public function storePharmacyLocation(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $pharmacy = Pharmacy::find($id);

        if (!$pharmacy) {
            return response()->json(['message' => 'Pharmacy not found'], 404);
        }

        if (!is_null($pharmacy->latitude) && !is_null($pharmacy->longitude)) {
            return response()->json([
                'message' => 'Location already exists and cannot be updated',
            ], 403);
        }

        // Update the location
        $pharmacy->latitude = $request->latitude;
        $pharmacy->longitude = $request->longitude;
        $pharmacy->save();

        return response()->json([
            'message' => 'Pharmacy location saved successfully',
            'pharmacy' => $pharmacy,
        ]);
    }

  

    public function getDoctorLocation($id)
    {
        $doctor = Doctor::select('latitude', 'longitude')->find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        return response()->json([
            'latitude' => $doctor->latitude,
            'longitude' => $doctor->longitude,
        ]);
    }

    public function getPharmacyLocation($id)
    {
        $pharmacy = Pharmacy::select('latitude', 'longitude')->find($id);

        if (!$pharmacy) {
            return response()->json(['message' => 'Pharmacy not found'], 404);
        }

        return response()->json([
            'latitude' => $pharmacy->latitude,
            'longitude' => $pharmacy->longitude,
        ]);
    }
}
