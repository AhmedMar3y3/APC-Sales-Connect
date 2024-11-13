<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\LeaderCode;
use Illuminate\Support\Facades\Auth;




class LeaderAuthController extends Controller
{
    public function register(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:admins',
        'password' => 'required|string',
        'role' => 'required|in:علمي,تجاري',
        'name' => 'required|string',
    ]);
    
    // Check if there are less than two leaders (one for each role).
    if (Leader::where('role', $validated['role'])->exists()) {
        return response()->json(['message' => 'A leader with this role already exists.'], 403);
    }
    
    $leader = Leader::create([
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
        'name' => $validated['name'],
    ]);

    $supervisorCode = Str::random(10);

    LeaderCode::create([
        'code' => $supervisorCode,
        'leader_id' => $leader->id,
        'status' => 'active',
    ]);

    return response()->json([
        'message' => 'Leader registration successful',
        'leader' => $leader,
        'supervisor_code' => $supervisorCode,
    ], 201);
}

    public function loadLoginPage(){
        return view('Leader.login');
    }
   
public function loginUser(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::guard('leader')->attempt($credentials)) {
        return redirect()->route('leader.dashboard')->with('success', 'Logged in successfully.');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput();
}

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('leader.loginPage')->with('success', 'Logged out successfully.');
    }
    public function index()
    {
        return view('Leader.dashboard');
    }
}
