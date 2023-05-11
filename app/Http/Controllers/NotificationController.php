<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Inertia\Inertia;
use Inertia\Response;

class NotificationController extends Controller
{
    //

    public function store(Request $request): RedirectResponse
    {
        $notification_id = $request->input('notification_id');
        $request->user()->unreadNotifications->where('id', $notification_id)->markAsRead();

        return redirect()->back()->with('message', 'Notification with id: '.$notification_id.' has been marked as read');
    }

    public function index(): Response
    {
        return Inertia::render('notification/Index');
    }
}
