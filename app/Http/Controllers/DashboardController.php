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
        
        $reservations = Reservation::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();
            
        $borrowings = Borrowing::where('user_id', $user->id)
            ->orderBy('borrow_date', 'desc')
            ->get();
            
        $logs = Log::where('user_id', $user->id)
            ->orderBy('timestamp', 'desc')
            ->get();
            
        $incidents = Incident::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
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
        
        $reservations = Reservation::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();
            
        $borrowings = Borrowing::where('user_id', $user->id)
            ->orderBy('borrow_date', 'desc')
            ->get();
            
        $logs = Log::where('user_id', $user->id)
            ->orderBy('timestamp', 'desc')
            ->get();
            
        $incidents = Incident::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
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
