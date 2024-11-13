<?php

namespace App\Http\Controllers\Mandob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacy;

class PharmacyProfileController extends Controller
{
    public function pharmacyProfile($id){
        $pharmacy = Pharmacy::find($id);
        return $pharmacy;
    }
}
