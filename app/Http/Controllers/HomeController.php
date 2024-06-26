<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function store(ReservationRequest $request)
    {


        $data = $request->except('checkbox');
        $reservation = Reservation::create($data);

        $status = true;
        $msg = __('front.application_success');

        return response()->json(compact('status', 'msg'));
    }
}
