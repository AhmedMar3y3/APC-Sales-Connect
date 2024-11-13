<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leader;
use App\Models\Supervisor;
use App\Models\User;

class LeaderController extends Controller
{
    public function viewLeaders()
    {
        $leaders = Leader::all();
        return view('admin.leaders.index', compact('leaders'));
    }
    public function viewSupervisors($leaderId)
    {
        $supervisors = Supervisor::where('leader_id', $leaderId)->get();
        return view('admin.leaders.supervisors', compact('supervisors'));
    }
    public function viewRepresentatives($supervisorId)
    {
        $representatives = User::where('supervisor_id', $supervisorId)->get();
        return view('admin.leaders.representatives', compact('representatives'));
    }
}
