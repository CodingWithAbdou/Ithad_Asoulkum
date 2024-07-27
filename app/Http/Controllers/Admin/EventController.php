<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\ProjectModel;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = ProjectModel::where('route_key', 'events')->first();
        view()->share('model', $this->model);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::orderBy('created_at', 'desc')->get();
        return view('admin.events.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title_ar' => 'required',
            'title_en' => 'required',
            'type_ar' => 'required',
            'type_en' => 'required',
            'place_ar' => 'required',
            'place_en' => 'required',
            'note_ar' => 'required',
            'note_en' => 'required',
            'phone' => 'required|min:8',
            'date' => 'date',
        ]);

        $input = $request->all();

        Event::create($input);

        $status = true;
        $msg = __('dash.created successfully');
        $url = route('dashboard.' . $this->model->route_key . '.index');

        return response()->json(compact('status', 'msg', 'url'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Event $obj)
    {
        return view('admin.events.form', ['data' => $obj]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $obj)
    {
        $this->validate($request, [
            'title_ar' => 'required',
            'title_en' => 'required',
            'type_ar' => 'required',
            'type_en' => 'required',
            'place_ar' => 'required',
            'place_en' => 'required',
            'note_ar' => 'required',
            'note_en' => 'required',
            'phone' => 'required|min:8',
            'date' => 'date',
        ]);

        $input = $request->all();
        $obj->update($input);


        $status = true;
        $msg = __('dash.updated successfully');
        $url = route('dashboard.' . $this->model->route_key . '.index');

        return response()->json(compact('status', 'msg', 'url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Event $obj)
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
