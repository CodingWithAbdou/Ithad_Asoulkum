<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $model_name = 'User';

    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'name' => 'required|string',
            'phone_number' => 'nullable|string',
            'job_title' => 'nullable|string',
            'company' => 'nullable|string',
            'id_number' => 'nullable|string',
        ]);
        unset($request['email']);
        $input = $request->all();

        try {
            $user->update($input);
        } catch (\Exception $e) {
            $status = false;
            $msg = $e->getMessage();
            return response()->json(compact('status', 'msg'));
        }

        $status = true;
        $msg = __('dash.updated successfully');
        $url = route('dashboard.home');

        return response()->json(compact('status', 'msg', 'url'));
    }

    public function password()
    {
        $user = auth()->user();
        return view('admin.profile.password', compact('user'));
    }

    public function update_password(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'current_password' => 'required|current_password|min:8',
            'password' => 'required|string|confirmed|min:8',
        ]);

        try {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        } catch (\Exception $e) {
            $status = false;
            $msg = $e->getMessage();
            return response()->json(compact('status', 'msg'));
        }

        $status = true;
        $msg = __('dash.updated successfully');
        $url = route('dashboard.home');

        return response()->json(compact('status', 'msg', 'url'));
    }
}
