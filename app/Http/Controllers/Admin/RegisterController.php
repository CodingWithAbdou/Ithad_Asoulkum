<?php
// app/Http/Controllers/Admin/RegisterController.php


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect()->route('dashboard.verify.show');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
           
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showVerificationForm()
    {
        return view('admin.auth.verify');
    }

    public function verifyEmail(Request $request)
    {
        // Verification logic here
    }

    public function showCompleteProfileForm()
    {
        return view('admin.auth.complete_profile');
    }

    public function completeProfile(Request $request)
    {
        // Profile completion logic here
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard.profile.complete');
    }
}