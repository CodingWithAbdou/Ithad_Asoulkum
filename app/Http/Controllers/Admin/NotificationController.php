<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(Request $request)
    {
        Alert::where('user_id', $request->number_user)->update(['alert' => 0]);
        return response()->json(['message' => 'Notifications marked as read']);
    }
}
