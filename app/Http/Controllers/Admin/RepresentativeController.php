<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RepresentativeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $representatives = User::where(function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'LIKE', "%$search%")
                      ->orWhere('email', 'LIKE', "%$search%");
            }
        })->get();

        return view('Admin.representatives.index', compact('representatives'));
    }
    
    public function show($id)
{
    $representative = User::with(['visits' => function ($query) {
        $query->orderBy('date', 'desc')->orderBy('time', 'desc');
    }])->find($id);

    if (!$representative) {
        return redirect()->route('admin.representatives.index')->with('error', 'Representative not found');
    }

    return view('Admin.representatives.show', compact('representative'));
}


}
