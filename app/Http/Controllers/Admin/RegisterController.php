<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->generateCode();

        // Send verification email
        Mail::to($user->email)->send(new VerificationCode($user->code));

        return redirect()->route('dashboard.verify.show')->with('email', $user->email);
    }

    public function showVerificationForm()
    {
        return view('admin.auth.verify');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'code' => 'required|array|size:6',
            'code.*' => 'required|numeric|digits:1',
        ]);

        $code = implode('', $request->code);
        $user = User::where('code', $code)->where('expire', '>', now())->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }

        $user->email_verified_at = now();
        $user->code = null;
        $user->expire = null;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard.home');
    }
}