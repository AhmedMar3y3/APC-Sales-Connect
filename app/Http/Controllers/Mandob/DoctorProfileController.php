<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorProfileController extends Controller
{
    public function doctorProfile($id){
        $doctor = Doctor::find($id);
        return $doctor;
    }
}
