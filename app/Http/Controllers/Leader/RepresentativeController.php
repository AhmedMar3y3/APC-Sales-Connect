<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supervisor;

class RepresentativeController extends Controller
{
    public function index(Request $request)
    {
        $supervisorIds = Supervisor::where('leader_id', auth('leader')->id())->pluck('id');
        $representatives = User::whereIn('supervisor_id', $supervisorIds)
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->get();

        return view('Leader.representatives.index', compact('representatives'));
    }

    public function show($id)
    {
        $representative = User::with(['visits' => function ($query) {
            $query->orderBy('date', 'desc')->orderBy('time', 'desc');
        }])->find($id);

        if (!$representative) {
            return redirect()->route('leader.representatives.index')->with('error', 'Representative not found');
        }

        return view('Leader.representatives.show', compact('representative'));
    }
}

