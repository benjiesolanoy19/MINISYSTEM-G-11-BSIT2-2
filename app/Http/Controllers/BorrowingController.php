<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrowing;
use App\Models\Equipment;
use App\Models\Notification;

class BorrowingController extends Controller
{
    public function create()
    {
        $equipment = Equipment::where('status', 'available')
            ->where('available_quantity', '>', 0)
            ->get();
        return view('borrowings.create', compact('equipment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
            'purpose' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $equipment = Equipment::findOrFail($validated['equipment_id']);

        if ($equipment->available_quantity < 1) {
            return back()->with('error', 'Equipment not available!');
        }

        $borrowing = Borrowing::create([
            'user_id' => Auth::id(),
            'equipment_id' => $validated['equipment_id'],
            'borrow_date' => $validated['borrow_date'],
            'return_date' => $validated['return_date'],
            'purpose' => $validated['purpose'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        // Update equipment quantity
        $equipment->decrement('available_quantity');

        // Notify staff
        $this->notifyStaff('New borrowing request from ' . Auth::user()->name . ' for ' . $equipment->name . ' (' . $validated['purpose'] . ')');

        return redirect()->route('borrowings.list')->with('success', 'Borrowing request submitted successfully!');
    }

    public function index()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with('equipment')
            ->orderBy('borrow_date', 'desc')
            ->get();
        return view('borrowings.list', compact('borrowings'));
    }

    public function manage()
    {
        $borrowings = Borrowing::with('user', 'equipment')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('borrowings.manage', compact('borrowings'));
    }

    public function approve(Request $request, Borrowing $borrowing)
    {
        $borrowing->update(['status' => 'approved']);
        
        Notification::create([
            'user_id' => $borrowing->user_id,
            'message' => 'Your borrowing request for ' . $borrowing->equipment->name . ' has been approved!',
            'type' => 'success',
        ]);

        return back()->with('success', 'Borrowing approved!');
    }

    public function return(Request $request, Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'returned',
            'return_date' => now()->toDateString(),
        ]);
        
        // Update equipment quantity
        $borrowing->equipment->increment('available_quantity');
        
        Notification::create([
            'user_id' => $borrowing->user_id,
            'message' => 'Your borrowing for ' . $borrowing->equipment->name . ' has been marked as returned.',
            'type' => 'success',
        ]);

        return back()->with('success', 'Equipment returned successfully!');
    }

    public function markDamaged(Request $request, Borrowing $borrowing)
    {
        $borrowing->update(['status' => 'damaged']);
        
        $borrowing->equipment->update(['status' => 'maintenance']);
        
        return back()->with('success', 'Equipment marked as damaged!');
    }

    public function markLost(Request $request, Borrowing $borrowing)
    {
        $borrowing->update(['status' => 'lost']);
        
        $borrowing->equipment->update(['status' => 'lost']);
        
        return back()->with('success', 'Equipment marked as lost!');
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
