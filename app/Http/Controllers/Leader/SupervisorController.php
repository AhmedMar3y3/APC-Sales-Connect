<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\User;

class SupervisorController extends Controller
{
    public function index()
    {
        $supervisors = Supervisor::where('leader_id',auth('leader')->id())->get();
        return view('Leader.supervisors.index',compact('supervisors'));
    }
    public function viewRepresentatives($supervisorId)
    {
        $representatives = User::where('supervisor_id', $supervisorId)->get();
        return view('Leader.supervisors.representatives', compact('representatives'));
    }
    
}
