<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        
        if ($notification->notifiable_id === auth()->id()) {
            $notification->markAsRead();
            return redirect()->back()->with('success', 'Notification marked as read.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
