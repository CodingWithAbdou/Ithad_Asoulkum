<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([

            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->alert()->create([
            'user_id' => $user->id,
            'alert' => 0,
        ]);

        $user->generateCode();
        Mail::to($user->email)->send(new VerificationCode($user->code));
        session(['email' => $user->email]);
        return response()->json(['success' => true, 'redirect' => route('dashboard.verify.register')]);
    }

    public function showVerificationForm()
    {
        return view('admin.auth.verify-register');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'code' => 'required|array|size:6',
            'code.*' => 'required|numeric|digits:1',
        ]);

        $code = implode('', $request->code);
        $user = User::where('code', $code)
            ->where('expire', '>', now())
            ->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired code.']);
        }

        $user->email_verified_at = now();
        $user->code = null;
        $user->expire = null;
        $user->save();

        session(['email' => $user->email]);

        return response()->json(['success' => true, 'redirect' => route('dashboard.profile.complete.show')]);
    }



    public function showCompleteProfileForm(Request $request)
    {
        return view('admin.auth.complete-profile');
    }

    public function completeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'phone_number' => 'required|string|max:17|min:8',
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|',
            'id_number' => 'required|string',
            'agree' => 'required',
        ]);
        $user = User::where('email', session('email'))->firstOrFail();
        $user->update($request->only(['name', 'phone_number', 'job_title', 'company', 'id_number']));

        Auth::login($user);
        session()->forget('email');
        return response()->json(['success' => true, 'redirect' => route('dashboard.home')]);
    }


    public function freshCodeEmail()
    {
        $user = User::where('email', session('email'))->firstOrFail();
        $user->generateCode();
        Mail::to($user->email)->send(new VerificationCode($user->code));
        return response()->json(['success' => true]);
    }
}
