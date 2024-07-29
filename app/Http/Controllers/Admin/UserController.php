<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public $model;
    public $route_key;

    public function __construct()
    {
        $currentRouteName = Route::currentRouteName();
        if ($currentRouteName[1] == 'admins') {
            $this->route_key = 'admins';
        } else {
            $this->route_key = 'agents';
        }
        $this->model = ProjectModel::where('route_key', $this->route_key)->first();
        view()->share('model', $this->model);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ($this->route_key == 'admins') {
            $data = User::where('role_id', '1')->orderBy('created_at', 'desc')->get();
        } else {
            $data = User::where('role_id', '2')->orderBy('created_at', 'desc')->get();
        }
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'image' => 'nullable|max:' . getMaxSize() . '|mimes:' . acceptImageType(0),
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if ($request->image) {
            $input['image'] = generalUpload('User', $request->image);
        }
        $data = User::create($input);

        $status = true;
        $msg = __('dash.created successfully');
        $url = route('dashboard.' . $this->model->route_key . '.index');

        return response()->json(compact('status', 'msg', 'url'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $obj)
    {
        return view('admin.users.form', ['data' => $obj]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $obj)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $obj->id,
            'phone' => 'nullable|size:17|unique:users,phone,' . $obj->id,
            'image' => 'nullable|max:' . getMaxSize() . '|mimes:' . acceptImageType(0),
        ]);

        $input = $request->all();

        if (!$request->get('password')) {
            $input = Arr::except($input, ['password']);
        } else {
            $input['password'] = Hash::make($input['password']);
        }

        if ($request->image) {
            $input['image'] = generalUpload($this->model->model, $request->image);
        } else {
            $input['image'] = $obj->image;
        }

        $obj->update($input);


        $status = true;
        $msg = __('dash.updated successfully');
        $url = route('dashboard.' . $this->model->route_key . '.index');

        return response()->json(compact('status', 'msg', 'url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $obj)
    {
        try {
            $obj->delete();
            $status = true;
            $msg = __('dash.deleted_successfully');
        } catch (\Exception $e) {
            $status = false;
            $msg = $e->getMessage();
        }
        return response()->json(compact('status', 'msg'));
    }
}
