<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Equipment;
use App\Models\Log;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Gather admin dashboard statistics
        $totalUsers = User::count();
        $studentCount = User::where('role', 'student')->count();
        $staffCount = User::where('role', 'staff')->count();
        $totalEquipment = Equipment::count();
        $recentLogs = Log::latest()->take(10)->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'studentCount' => $studentCount,
            'staffCount' => $staffCount,
            'totalEquipment' => $totalEquipment,
            'recentLogs' => $recentLogs,
        ]);
    }

    public function users()
    {
        // Use existing admin users management view
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function equipment()
    {
        // Use existing admin equipment management view
        $equipment = Equipment::paginate(20);
        return view('admin.equipment', compact('equipment'));
    }

    public function logs()
    {
        // Use existing admin logs view
        $logs = Log::latest()->paginate(50);
        return view('admin.logs', compact('logs'));
    }
}
