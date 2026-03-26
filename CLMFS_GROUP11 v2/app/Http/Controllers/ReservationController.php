<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Laboratory;
use App\Models\Notification;

class ReservationController extends Controller
{
    public function create()
    {
        $laboratories = Laboratory::where('status', 'available')->get();
        return view('reservations.create', compact('laboratories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'laboratory_id' => 'required|exists:laboratories,id',
            'date' => 'required|date|after_or_equal:today',
            'time_in' => 'required',
            'time_out' => 'required|after:time_in',
            'purpose' => 'nullable|string',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'laboratory_id' => $validated['laboratory_id'],
            'date' => $validated['date'],
            'time_in' => $validated['time_in'],
            'time_out' => $validated['time_out'],
            'purpose' => $validated['purpose'] ?? null,
            'status' => 'pending',
        ]);

        // Create notification for staff/admin
        $this->notifyStaff('New reservation request from ' . Auth::user()->name);

        return redirect()->route('reservations.list')->with('success', 'Reservation submitted successfully!');
    }

    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
        return view('reservations.list', compact('reservations'));
    }

    public function manage()
    {
        $reservations = Reservation::with('user', 'laboratory')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('reservations.manage', compact('reservations'));
    }

    public function approve(Request $request, Reservation $reservation)
    {
        $reservation->update(['status' => 'approved']);
        
        Notification::create([
            'user_id' => $reservation->user_id,
            'message' => 'Your reservation for ' . $reservation->laboratory->name . ' has been approved!',
            'type' => 'success',
        ]);

        return back()->with('success', 'Reservation approved!');
    }

    public function reject(Request $request, Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);
        
        Notification::create([
            'user_id' => $reservation->user_id,
            'message' => 'Your reservation for ' . $reservation->laboratory->name . ' has been cancelled.',
            'type' => 'error',
        ]);

        return back()->with('success', 'Reservation rejected!');
    }

    public function complete(Reservation $reservation)
    {
        $reservation->update(['status' => 'completed']);
        return back()->with('success', 'Reservation marked as completed!');
    }

    private function notifyStaff($message)
    {
        $staff = \App\Models\User::whereIn('role', ['admin', 'staff'])->get();
        foreach ($staff as $user) {
            Notification::create([
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'info',
            ]);
        }
    }
}
