<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SupervisorCode;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaderCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loadRegisterForm(){
        return view('Supervisor.register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:supervisors',
            'password' => 'required|string|confirmed',
            'leader_code' => 'required|string|exists:leader_codes,code,status,active',
        ]);
    
        $leaderCode = LeaderCode::where('code', $validated['leader_code'])
                                ->where('status', 'active')
                                ->first();
    
        if (!$leaderCode) {
            return back()->with('error', 'Invalid or expired leader code.')->withInput();
        }
    
        $leader = $leaderCode->leader;
        $leaderRole = $leader->role;
    
        $supervisor = Supervisor::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $leaderRole,
            'password' => Hash::make($validated['password']),
            'leader_id' => $leader->id,
        ]);
    
        $supervisorCode = Str::random(10);
        SupervisorCode::create([
            'code' => $supervisorCode,
            'supervisor_id' => $supervisor->id,
            'status' => 'active',
        ]);
    
        return redirect()->route('supervisor.registerform')->with('success', 'Registration successful. Your code is: ' . $supervisorCode);
    }
    
    
    
    
    public function loadLoginPage(){
        return view('supervisor.login');
    }
   
public function loginUser(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::guard('supervisor')->attempt($credentials)) {
        return redirect()->route('supervisor.dashboard')->with('success', 'Logged in successfully.');
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
    public function index()
    {
        return view('supervisor.dashboard');
    }
    public function loadForgotPasswordForm()
    {
        return view('supervisor.forgot_password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $supervisor = Supervisor::where('email', $request->email)->first();
    
        if (!$supervisor) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }
    
        $code = mt_rand(100000, 999999);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $code,
                'created_at' => now()
            ]
        );
    
        Mail::raw("Your password reset code is: $code", function ($message) use ($supervisor) {
            $message->to($supervisor->email)
                ->subject('Password Reset Code');
        });
    
        return redirect()->route('supervisor.resetPasswordForm')->with('success', 'reset code sent to your email');
      }

    public function loadResetPasswordForm(Request $request)
    {
        return view('supervisor.reset_password', ['token' => $request->token, 'email' => $request->email]);
    }
 
 public function resetPassword(Request $request)
 {
    $request->validate([
        'email' => 'required|email',
        'code' => 'required|numeric',
        'password' => 'required|confirmed',
    ]);
 
    $resetEntry = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->where('token', $request->code)
        ->first();
 
  if (!$resetEntry) {
         return response()->json([
             'message' => 'Invalid code',
         ]);    }
    $supervisor = Supervisor::where('email', $request->email)->first();
    $supervisor->password = Hash::make($request->password);
    $supervisor->save();
 
    DB::table('password_reset_tokens')->where('email', $request->email)->delete();
    return redirect()->route('supervisor.loginPage')->with('success', 'Password reset successful. You can now log in with your new password.');
 }
 
  
}
  // public function forgotPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:supervisors,email',
    //     ]);

    //     $token = Str::random(60);

    //     Supervisor::where('email', $request->email)->update(['password_reset_token' => Crypt::encrypt($token)]);
    //     $resetLink = route('supervisor.resetPasswordForm', ['token' => $token, 'email' => $request->email]);

    //     Mail::send('emails.forgot_password', ['resetLink' => $resetLink], function ($message) use ($request) {
    //         $message->to($request->email);
    //         $message->subject('Password Reset Request');
    //     });

    //     return back()->with('success', 'Password reset link has been sent to your email.');
    // }

  

    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:supervisors,email',
    //         'token' => 'required',
    //         'password' => 'required|string|confirmed',
    //     ]);

    //     $supervisor = Supervisor::where('email', $request->email)->first();

    //     if (!Hash::check($request->token, $supervisor->password_reset_token)) {
    //         return back()->withErrors(['token' => 'Invalid or expired token.']);
    //     }

    //     $supervisor->password = Hash::make($request->password);
    //     $supervisor->password_reset_token = null; // Clear the reset token
    //     $supervisor->save();

    //     return redirect()->route('supervisor.loginPage')->with('success', 'Password reset successful. You can now log in with your new password.');
    // }