<?php

namespace App\Http\Controllers;

use App\Mail\otpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(){
        return view('Auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            //generate otp
            $otp = Str::random(6);
            $user = Auth::user();
            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(10);
            $user->save();

            // Send OTP via email (or any other method)
            Mail::to($user->email)->send(new otpMail($otp));

            // Log the user out
            Auth::logout();

            // Redirect to OTP verification page
            return redirect()->route('otp.verify');

        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }

    public function verifyOtp(Request $request)
    {
        return view('auth.verify-otp');
    }

    public function postVerifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string',
        ]);

        $user = User::where('otp', $request->otp)->where('otp_expires_at', '>=', Carbon::now())->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid OTP or OTP expired.']);
        }

        // Clear OTP after successful verification
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Log the user in
        Auth::login($user);

        if ($user->is_admin){
            return redirect()->route('admin.posts');
        }

        return redirect()->route('user.posts');
    }

    public function register(){
        return view('Auth.register');
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);

        event(new Registered($user));

        $user->sendEmailVerificationNotification();

        Auth::login($user);
        return redirect('/email/verify')->with('success', 'Registrasi berhasil!');

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
