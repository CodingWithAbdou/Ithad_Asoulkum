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
}
