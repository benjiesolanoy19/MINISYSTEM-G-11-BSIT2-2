<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Borrowing;
use App\Models\Equipment;
use App\Models\Laboratory;
use App\Models\User;
use App\Models\Log;
use App\Models\Incident;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Limit queries to improve performance
        $reservations = Reservation::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get();
            
        $borrowings = Borrowing::where('user_id', $user->id)
            ->orderBy('borrow_date', 'desc')
            ->limit(10)
            ->get();
            
        $logs = Log::where('user_id', $user->id)
            ->orderBy('timestamp', 'desc')
            ->limit(10)
            ->get();
            
        $incidents = Incident::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
            
        return view('dashboard.home', compact('user', 'reservations', 'borrowings', 'logs', 'incidents', 'notifications', 'unreadCount'));
    }
    
    public function main()
    {
        $user = Auth::user();
        
        // Limit queries to improve performance
        $reservations = Reservation::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get();
            
        $borrowings = Borrowing::where('user_id', $user->id)
            ->orderBy('borrow_date', 'desc')
            ->limit(10)
            ->get();
            
        $logs = Log::where('user_id', $user->id)
            ->orderBy('timestamp', 'desc')
            ->limit(10)
            ->get();
            
        $incidents = Incident::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
            
        return view('dashboard.home', compact('user', 'reservations', 'borrowings', 'logs', 'incidents', 'notifications', 'unreadCount'));
    }
}
