<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::orderBy('added_date', 'desc')->get();
        return view('notifications.index', compact('notifications')); 
    }


}
