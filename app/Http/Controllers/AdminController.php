<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Models\Equipment;
use App\Models\Log;
use App\Models\Incident;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $borrowings = \App\Models\BorrowRequest::with('student', 'equipment')->get();

        $equipment = Equipment::all();
        $logs = Log::with('user')->orderBy('timestamp', 'desc')->take(50)->get();
        $incidents = Incident::with('user', 'equipment')->get();

        // Fix undefined variable in resources/views/admin/index.blade.php
        // The view expects $reservations and iterates them.
        $reservations = \App\Models\BorrowRequest::query()
            ->with(['student', 'equipment'])
            ->latest('request_date')
            ->limit(10)
            ->get();

        $stats = [
            'total_users' => $users->count(),
            'total_equipment' => $equipment->count(),
            'total_borrowings' => $borrowings->count(),
            'pending_borrowings' => $borrowings->where('status', 'pending')->count(),
            'total_reservations' => $reservations->count(),
            'active_incidents' => $incidents->where('status', '!=', 'closed')->count(),
        ];

        return view('admin.index', compact('stats', 'users', 'borrowings', 'equipment', 'logs', 'incidents', 'reservations'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:student,staff,admin',
        ]);

        $user->update(['role' => $validated['role']]);
        return back()->with('success', 'User role updated!');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }
        $user->delete();
        return back()->with('success', 'User deleted!');
    }

    public function usage()
    {
        $borrowings_by_equipment = \App\Models\BorrowRequest::with('equipment')->get()->groupBy('equipment_id')->map->count();

        $user_activity = Log::with('user')->selectRaw('user_id, count(*) as logs_count')->groupBy('user_id')->get();
        return view('admin.reports.usage', compact('borrowings_by_equipment', 'user_activity'));
    }

    public function inventory()
    {
        $equipment = Equipment::all();
        return view('admin.reports.inventory', compact('equipment'));
    }

    public function transactions()
    {
        $transactions = \App\Models\BorrowRequest::with(['student', 'equipment'])->orderBy('request_date', 'desc')->get();

        return view('admin.reports.transactions', compact('transactions'));
    }
}
