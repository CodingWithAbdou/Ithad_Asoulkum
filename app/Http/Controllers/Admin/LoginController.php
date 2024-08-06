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
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        if (is_null($user->email_verified_at)) {
            $user->generateCode();
            Mail::to($user->email)->send(new VerificationCode($user->code));
            session(['email' => $user->email]);
            return response()->json(['success' => true, 'redirect' => route('dashboard.verify.register')]);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return response()->json(['success' => true, 'redirect' => route('dashboard.home')]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
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
        session(['email' => $user->email]);
        return response()->json(['success' => true, 'redirect' => route('dashboard.verify.show', ['reset' => true])]);
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
        $request->session()->put('reset_password', true);

        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Invalid or expired code.']);
        }

        if ($request->session()->has('reset_password')) {
            $request->session()->forget('reset_password');
            return response()->json(['success' => true, 'redirect' => route('password.reset', ['email' => $user->email])]);
        } else {
            if ($user->email_verified_at === null) {
                $user->email_verified_at = now();
                $user->save();
            }
            return response()->json(['error' => true, 'message' => 'Invalid or expired code.']);
        }
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
            'password_confirmation' => 'required|min:8|same:password',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Invalid email.']);
        }

        $user->password = Hash::make($request->password);
        $user->code = null;
        $user->expire = null;
        $user->save();

        return response()->json(['success' => true, 'redirect' => route('dashboard.login.index')]);
    }
}
