<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Borrowing;
use App\Models\Equipment;
use App\Models\Log;
use App\Models\Incident;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $reservations = Reservation::with('user', 'laboratory')->get();
        $borrowings = Borrowing::with('user', 'equipment')->get();
        $equipment = Equipment::all();
        $logs = Log::with('user')->orderBy('timestamp', 'desc')->take(50)->get();
        $incidents = Incident::with('user', 'equipment')->get();

        $stats = [
            'total_users' => $users->count(),
            'total_equipment' => $equipment->count(),
            'total_reservations' => $reservations->count(),
            'total_borrowings' => $borrowings->count(),
            'pending_reservations' => $reservations->where('status', 'pending')->count(),
            'pending_borrowings' => $borrowings->where('status', 'pending')->count(),
            'active_incidents' => $incidents->where('status', '!=', 'closed')->count(),
        ];

        return view('admin.index', compact('stats', 'users', 'reservations', 'borrowings', 'equipment', 'logs', 'incidents'));
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
        $reservations_by_lab = Reservation::with('laboratory')->get()->groupBy('laboratory_id')->map->count();
        $borrowings_by_equipment = Borrowing::with('equipment')->get()->groupBy('equipment_id')->map->count();
        $user_activity = Log::with('user')->selectRaw('user_id, count(*) as logs_count')->groupBy('user_id')->get();
        return view('admin.reports.usage', compact('reservations_by_lab', 'borrowings_by_equipment', 'user_activity'));
    }

    public function inventory()
    {
        $equipment = Equipment::all();
        return view('admin.reports.inventory', compact('equipment'));
    }

    public function transactions()
    {
        $transactions = Borrowing::with(['user', 'equipment'])->orderBy('created_at', 'desc')->get();
        return view('admin.reports.transactions', compact('transactions'));
    }
}

