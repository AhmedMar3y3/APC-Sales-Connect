<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\AdminCode;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:admins',
            'password' => 'required|string',
        ]);
        
        if (Admin::count() > 0) {
            return response()->json(['message' => 'An admin already exists.'], 403);
        }
        $admin = Admin::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $mandobCode = Str::random(10);

        AdminCode::create([
            'code' => $mandobCode,
            'admin_id' => $admin->id,
            'status' => 'active',
        ]);

        return response()->json([
            'message' => 'admin registration successful',
            'admin' => $admin,
            'Mandob Code' => $mandobCode,
        ], 201);
    }
    public function loadLoginPage(){
        return view('Admin.login');
    }
   
public function loginUser(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::guard('admin')->attempt($credentials)) {
        return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput();
}

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('loginPage')->with('success', 'Logged out successfully.');
    }
}
