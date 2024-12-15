<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->get();

        Auth::user()->notifications()->where('read', false)->update(['read' => true]);

        return view('notifications.index', compact('notifications'));
    }
}
