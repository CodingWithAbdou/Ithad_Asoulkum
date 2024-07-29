<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ResetPasswordOTP;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCode;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard.home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard.login.index');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetOTP(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'code' => $otp,
            'expire' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new ResetPasswordOTP($otp));

        return redirect()->route('dashboard.verify.show', ['reset' => true, 'email' => $user->email]);
    }

    public function showVerifyCodeForm(Request $request)
    {
        if ($request->has('reset')) {
            $request->session()->put('reset_password', true);
        }

        return view('admin.auth.verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|array|size:6',
            'code.*' => 'required|numeric|digits:1',
        ]);

        $code = implode('', $request->code);

        $user = User::where('email', $request->email)
                    ->where('code', $code)
                    ->where('expire', '>', now())
                    ->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }

        // Check if this is a password reset or new account verification
        if ($request->session()->has('reset_password')) {
            // Password reset
            $request->session()->forget('reset_password');

            return redirect()->route('password.reset')->with(['email' => $user->email]);
        } else {
            // New account verification
            if ($user->email_verified_at === null) {
                $user->email_verified_at = now();
                $user->save();
            }

            return redirect()->route('dashboard.profile.complete.show')->with(['email' => $user->email]);
        }
    }

    public function showCompleteProfileForm()
    {
        return view('admin.auth.complete-profile');
    }

    public function completeProfile(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'job_title' => 'required|string',
            'company' => 'required|string',
            'id_number' => 'required|string',
        ]);

        $user = User::where('email', session('email'))->firstOrFail();
        $user->update($request->only(['phone_number', 'job_title', 'company', 'id_number']));

        Auth::login($user);

        return redirect()->route('dashboard.home');
    }

    public function showResetPasswordForm(Request $request)
    {
        return view('admin.auth.reset-password')->with('email', $request->email);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $user->password = Hash::make($request->password);
        $user->code = null;
        $user->expire = null;
        $user->save();

        // Log the user in automatically
        Auth::login($user);

        // Redirect to dashboard
        return redirect()->route('dashboard.home')->with('status', 'Password has been reset successfully');
    }
}