<?php

namespace App\Http\Controllers;

use App\Models\BorrowRequest;
use App\Models\Equipment;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BorrowRequestController extends Controller
{
    public function indexEquipment()
    {
        $equipment = Equipment::query()->get();

        return view('borrowings.cards', compact('equipment'));
    }

    public function createBorrow(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => ['required', 'integer', 'exists:equipment,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $studentId = Auth::id();

        $existingPending = BorrowRequest::query()
            ->where('student_id', $studentId)
            ->where('equipment_id', $validated['equipment_id'])
            ->where('status', 'pending')
            ->exists();

        if ($existingPending) {
            return back()->with('error', 'You already have a pending request for this equipment.');
        }

        // Per spec: do NOT decrement available_quantity until approved.
        // Also per spec: if quantity > available, error.
        $equipment = Equipment::findOrFail($validated['equipment_id']);
        if ($validated['quantity'] > $equipment->available_quantity) {
            return back()->with('error', 'Requested quantity exceeds available quantity.');
        }

        BorrowRequest::create([
            'student_id' => $studentId,
            'equipment_id' => $validated['equipment_id'],
            'quantity' => $validated['quantity'],
            'status' => 'pending',
            'request_date' => now(),
        ]);

        return redirect()->route('equipment.index')->with('success', 'Borrow request submitted successfully.');
    }

    public function staffPendingRequests()
    {
        $this->authorizeStaff();

        $requests = BorrowRequest::query()
            ->where('status', 'pending')
            ->with(['student', 'equipment'])
            ->latest('request_date')
            ->get();

        return view('staff.pending-requests', compact('requests'));
    }

    public function staffApprove(Request $request, int $request_id, DatabaseManager $db)
    {
        $this->authorizeStaff();

        $borrowRequest = BorrowRequest::query()->with('equipment')->findOrFail($request_id);
        if ($borrowRequest->status !== 'pending') {
            return back()->with('error', 'This request is not pending.');
        }

        $quantity = $borrowRequest->quantity;
        $equipment = $borrowRequest->equipment;

        if ($quantity > $equipment->available_quantity) {
            return back()->with('error', 'Cannot approve: requested quantity exceeds current available quantity.');
        }

        $db->transaction(function () use ($borrowRequest, $equipment) {
            // Re-check inside transaction for correctness
            $equipment->refresh();
            if ($borrowRequest->quantity > $equipment->available_quantity) {
                throw new \RuntimeException('Quantity exceeds available quantity.');
            }

            // Deduct on approval
            $equipment->decrement('available_quantity', $borrowRequest->quantity);

            $borrowRequest->update([
                'status' => 'approved',
                'approval_date' => now(),
                'approved_by' => Auth::id(),
            ]);
        });

        return back()->with('success', 'Borrow request approved.');
    }

    public function staffReject(Request $request, int $request_id)
    {
        $this->authorizeStaff();

        $borrowRequest = BorrowRequest::findOrFail($request_id);
        if ($borrowRequest->status !== 'pending') {
            return back()->with('error', 'This request is not pending.');
        }

        $borrowRequest->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Borrow request rejected.');
    }

    public function allBorrows(Request $request)
    {
        $role = Auth::user()->role ?? null;
        if (!in_array($role, ['admin', 'staff'])) {
            abort(403);
        }

        $requests = BorrowRequest::query()
            ->with(['student', 'equipment', 'approvedBy'])
            ->latest('request_date')
            ->get();

        return view('staff.all-borrows', compact('requests'));
    }

    public function adminUsers()
    {
        $this->authorizeAdmin();

        $users = \App\Models\User::all();
        return view('admin.users.index', compact('users'));
    }

    public function adminEquipment()
    {
        $this->authorizeAdmin();

        $equipment = Equipment::all();
        return view('admin.equipment.index', compact('equipment'));
    }

    private function authorizeStaff(): void
    {
        $role = Auth::user()->role ?? null;
        if (!in_array($role, ['staff', 'admin'])) {
            abort(403);
        }
        if ($role === 'admin') {
            // Per spec: Admin cannot approve/reject
            // This authorizeStaff is used by staff approve/reject endpoints.
            // So abort here for admin.
            abort(403);
        }
    }

    private function authorizeAdmin(): void
    {
        $role = Auth::user()->role ?? null;
        if ($role !== 'admin') {
            abort(403);
        }
    }
}

