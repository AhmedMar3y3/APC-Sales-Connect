<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supervisor;


class RepresentativeController extends Controller
{
    public function index(Request $request)
    {
        $representatives = User::where('supervisor_id', auth('supervisor')->id())
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->get();

        return view('Supervisor.representatives.index', compact('representatives'));
    }

    public function show($id)
    {
        $representative = User::with(['visits' => function ($query) {
            $query->orderBy('date', 'desc')->orderBy('time', 'desc');
        }])->find($id);

        if (!$representative) {
            return redirect()->route('supervisor.representatives.index')->with('error', 'Representative not found');
        }

        return view('Supervisor.representatives.show', compact('representative'));
    }
}
