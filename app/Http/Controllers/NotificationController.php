<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display list of all notifications
     */
    public function index(Request $request)
    {
        $query = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        // Filter by read status
        if ($request->has('filter') && $request->filter !== 'all') {
            if ($request->filter === 'unread') {
                $query->unread();
            } elseif ($request->filter === 'read') {
                $query->read();
            }
        }

        // Filter by type
        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('message', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%');
            });
        }

        $notifications = $query->paginate(20);
        
        return view('notifications.list', compact('notifications'));
    }

    /**
     * Show notification and redirect to action URL
     */
    public function show(Notification $notification)
    {
        // Check authorization
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Mark as read
        $notification->markAsRead();

        // If there's an action URL, redirect there
        if ($notification->action_url) {
            return redirect($notification->action_url);
        }

        // Otherwise redirect to notifications list
        return redirect()->route('notifications.index');
    }

    /**
     * Mark single notification as read (via AJAX or form)
     */
    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id === Auth::id()) {
            $notification->markAsRead();
        }

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'unread_count' => Notification::where('user_id', Auth::id())
                    ->unread()
                    ->count(),
            ]);
        }

        return back();
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'All notifications marked as read',
                'unread_count' => 0,
            ]);
        }

        return back()->with('success', 'All notifications marked as read');
    }

    /**
     * Delete a notification
     */
    public function destroy(Notification $notification)
    {
        if ($notification->user_id === Auth::id()) {
            $notification->delete();
        }

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification deleted');
    }

    /**
     * Delete all read notifications
     */
    public function destroyRead()
    {
        Notification::where('user_id', Auth::id())
            ->read()
            ->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Read notifications deleted');
    }

    /**
     * Get unread count (AJAX endpoint for real-time updates)
     */
    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->unread()
            ->count();

        return response()->json([
            'count' => $count,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * Get recent notifications (AJAX endpoint)
     */
    public function getRecent($limit = 10)
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'type' => $notification->type,
                    'icon' => $notification->getIconAttribute(),
                    'color' => $notification->getColorClass(),
                    'is_read' => $notification->is_read,
                    'action_url' => $notification->action_url,
                    'time_ago' => $notification->created_at->diffForHumans(),
                    'created_at' => $notification->created_at->toIso8601String(),
                ];
            });

        return response()->json([
            'notifications' => $notifications,
            'count' => $notifications->count(),
        ]);
    }
}
