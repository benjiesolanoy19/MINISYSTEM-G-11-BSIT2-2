<?php

namespace App\Http\Controllers;

use App\Models\BorrowRequest;
use App\Models\Equipment;
use App\Models\Notification;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class BorrowRequestController extends Controller
{
    // NOTE: Using middleware() here caused an error in this project setup.
    // Authentication is handled via route middleware (routes/web.php) / AdminAuth.


    /*
     * Student borrow equipment page (cards listing)
     */
    public function indexEquipment()
    {
        $this->authorizeStudentOnly();

        $equipment = Equipment::query()->get();
        return view('borrowings.cards', compact('equipment'));
    }

    /*
     * Generic entry used by /borrowings
     */
    public function index(Request $request)
    {
        $role = Auth::user()->role ?? null;

        if (in_array($role, ['staff', 'admin'], true)) {
            return $this->allBorrows($request);
        }

        return $this->myRequests($request);
    }

    /*
     * Student create borrow request
     * Note: route in routes/borrowings.php uses POST /borrow
     */
    public function createBorrow(Request $request)
    {
        $role = Auth::user()->role ?? null;
        if (in_array($role, ['staff', 'admin'], true)) {
            abort(403);
        }

        $validated = $request->validate([
            'equipment_id' => ['required', 'integer', 'exists:equipment,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'borrow_date' => ['required', 'date', 'after_or_equal:today'],
            'return_date' => ['required', 'date', 'after:borrow_date'],
            'purpose' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:500'],
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

        $equipment = Equipment::findOrFail($validated['equipment_id']);
        if ($validated['quantity'] > ($equipment->available_quantity ?? 0)) {
            return back()->with('error', 'Requested quantity exceeds available quantity.');
        }

        $borrowRequest = BorrowRequest::create([
            'student_id' => $studentId,
            'equipment_id' => $validated['equipment_id'],
            'quantity' => $validated['quantity'],
            'status' => 'pending',
            'request_date' => now(),
            'borrow_date' => $validated['borrow_date'],
            'return_date' => $validated['return_date'],
            'purpose' => $validated['purpose'],
            'notes' => $validated['notes'] ?? null,
        ]);

        $this->notifyStaff(
            'New borrow request from ' . Auth::user()->name . ' for ' . $equipment->name . '.',
            'borrow_request',
            $borrowRequest->id,
            'BorrowRequest',
            route('borrowings.index', ['view' => 'pending']),
            'New Borrow Request'
        );

        return redirect()->route('borrowings.equipment.index')->with('success', 'Borrow request submitted successfully.');
    }

    /*
     * Student views
     */
    public function myRequests(Request $request)
    {
        $role = Auth::user()->role ?? null;
        if (in_array($role, ['staff', 'admin'], true)) {
            abort(403);
        }

        $this->syncOverdueStatuses();

        $requests = BorrowRequest::query()
            ->where('student_id', Auth::id())
            ->with(['equipment', 'approvedBy'])
            ->latest('request_date')
            ->get();

        return view('borrowings.my-borrow-requests', compact('requests'));
    }

    public function showReturnEquipment(Request $request)
    {
        $role = Auth::user()->role ?? null;
        if (in_array($role, ['staff', 'admin'], true)) {
            abort(403);
        }

        $this->syncOverdueStatuses();
        $userId = Auth::id();

        $borrowedItems = BorrowRequest::query()
            ->where('student_id', $userId)
            ->where('status', 'claimed')
            ->with(['equipment', 'approvedBy'])
            ->latest('claimed_at')
            ->get();

        $activeBorrowings = BorrowRequest::where('student_id', $userId)
            ->whereIn('status', ['claimed', 'return_requested'])
            ->count();

        $pendingReturns = BorrowRequest::where('student_id', $userId)
            ->where('status', 'return_requested')
            ->count();

        $completedReturns = BorrowRequest::where('student_id', $userId)
            ->where('status', 'returned')
            ->count();

        $overdueItems = BorrowRequest::where('student_id', $userId)
            ->where('status', 'overdue')
            ->count();

        $returnHistory = BorrowRequest::query()
            ->where('student_id', $userId)
            ->whereIn('status', ['returned', 'overdue'])
            ->with(['equipment'])
            ->latest('returned_at')
            ->limit(10)
            ->get();

        return view('borrowings.return-equipment', compact(
            'borrowedItems',
            'activeBorrowings',
            'pendingReturns',
            'completedReturns',
            'overdueItems',
            'returnHistory'
        ));
    }

    public function submitReturn(Request $request)
    {
        $role = Auth::user()->role ?? null;
        if (in_array($role, ['staff', 'admin'], true)) {
            abort(403);
        }

        $validated = $request->validate([
            'request_id' => ['required', 'integer', 'exists:borrow_requests,id'],
            'condition' => ['required', 'in:good,minor_damage,major_damage'],
            'return_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $borrowRequest = BorrowRequest::query()
            ->where('student_id', Auth::id())
            ->findOrFail($validated['request_id']);

        if ($borrowRequest->status !== 'claimed') {
            return back()->with('error', 'Only claimed equipment can be submitted for return.');
        }

        $borrowRequest->update([
            'status' => 'return_requested',
            'return_requested_at' => now(),
            'return_condition' => $validated['condition'],
            'remarks' => $validated['return_notes'] ?? null,
        ]);

        $this->notifyStaff('Return request from ' . Auth::user()->name . ' for ' . $borrowRequest->equipment->name . '.');

        return back()->with('success', 'Return request submitted successfully. Staff will verify the equipment shortly.');
    }

    public function studentRequestReturn(Request $request, int $request_id)
    {
        $borrowRequest = BorrowRequest::query()
            ->where('student_id', Auth::id())
            ->findOrFail($request_id);

        if ($borrowRequest->status !== 'claimed') {
            return back()->with('error', 'Return request can only be submitted after equipment has been claimed.');
        }

        $borrowRequest->update([
            'status' => 'return_requested',
            'return_requested_at' => now(),
        ]);

        $this->notifyStaff('Return requested for ' . $borrowRequest->equipment->name . ' by ' . Auth::user()->name . '.');

        return back()->with('success', 'Return request submitted. Staff will confirm the return shortly.');
    }

    /*
     * Staff/Admin views and actions
     */
    public function showReturnManagement(Request $request)
    {
        $this->authorizeStaff();
        $this->syncOverdueStatuses();

        $pendingReturns = BorrowRequest::where('status', 'return_requested')->count();

        $completedToday = Schema::hasColumn('borrow_requests', 'returned_at')
            ? BorrowRequest::where('status', 'returned')->whereDate('returned_at', now()->toDateString())->count()
            : 0;

        $damagedItems = Schema::hasColumn('borrow_requests', 'return_condition')
            ? BorrowRequest::whereIn('status', ['return_requested', 'returned'])
                ->whereIn('return_condition', ['minor_damage', 'major_damage'])
                ->count()
            : 0;

        $overdueItems = BorrowRequest::where('status', 'overdue')->count();

        $orderColumn = Schema::hasColumn('borrow_requests', 'return_requested_at')
            ? 'return_requested_at'
            : (Schema::hasColumn('borrow_requests', 'request_date') ? 'request_date' : null);

        $returnRequestsQuery = BorrowRequest::query()
            ->where('status', 'return_requested')
            ->with(['student', 'equipment', 'approvedBy'])
            ->when($request->query('q'), function ($query, $term) {
                $term = '%' . trim($term) . '%';
                return $query->where(function ($sub) use ($term) {
                    $sub->whereHas('student', function ($q) use ($term) {
                        $q->where('name', 'like', $term);
                    })
                        ->orWhereHas('equipment', function ($q) use ($term) {
                            $q->where('name', 'like', $term);
                        });
                });
            })
            ->when(
                $request->query('condition') && Schema::hasColumn('borrow_requests', 'return_condition'),
                function ($query) use ($request) {
                    return $query->where('return_condition', $request->query('condition'));
                }
            );

        if ($orderColumn) {
            $returnRequestsQuery->orderBy($orderColumn, 'desc');
        }

        $returnRequests = $returnRequestsQuery->get();

        $recentReturns = Schema::hasColumn('borrow_requests', 'returned_at')
            ? BorrowRequest::query()
                ->where('status', 'returned')
                ->with(['student', 'equipment'])
                ->latest('returned_at')
                ->limit(10)
                ->get()
            : collect();

        return view('staff.return-management', compact(
            'pendingReturns',
            'completedToday',
            'damagedItems',
            'overdueItems',
            'returnRequests',
            'recentReturns'
        ));
    }

    public function staffPendingRequests()
    {
        $this->authorizeStaff();
        $this->syncOverdueStatuses();

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

            // Avoid eager-loading student relation because FK-mismatched legacy rows
            // may cause issues when relationships are resolved.
            $borrowRequest = BorrowRequest::query()->with('equipment')->findOrFail($request_id);
            if ($borrowRequest->status !== 'pending') {
            return back()->with('error', 'This request is not pending.');
        }

        $quantity = $borrowRequest->quantity;
        $equipment = $borrowRequest->equipment;

        if ($quantity > ($equipment->available_quantity ?? 0)) {
            return back()->with('error', 'Cannot approve: requested quantity exceeds current available quantity.');
        }

        $db->transaction(function () use ($borrowRequest, $equipment) {
            $equipment->refresh();
            if ($borrowRequest->quantity > ($equipment->available_quantity ?? 0)) {
                throw new \RuntimeException('Quantity exceeds available quantity.');
            }

            // Data-integrity safeguard:
            // If this legacy row references a student_id that doesn't exist in users,
            // the FK will throw. In that case, mark it as rejected to prevent 500s.
            $studentExists = \App\Models\User::query()
                ->where('id', $borrowRequest->student_id)
                ->exists();

            if (!$studentExists) {
                // FK integrity would fail on UPDATE as well (because FK is on the existing student_id).
                // Avoid 500 by only setting status/remarks when FK allows it.
                // If FK is enforced strictly, we cannot safely change this row without reseeding data.
                // Therefore, immediately return an error response for staff.
                return back()->with('error', 'Cannot approve/reject this request: invalid student_id (data integrity issue).');
            }

            // No inventory change on approve (only on claimed)
            $borrowRequest->update([
                'status' => 'approved',
                'approval_date' => now(),
                'approved_by' => Auth::id(),
            ]);
        });

        $this->notifyUser((int) $borrowRequest->student_id, 'Your borrow request for ' . $equipment->name . ' has been approved.');

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
            'remarks' => $request->input('remarks') ?? $borrowRequest->remarks,
        ]);

        $this->notifyUser((int) $borrowRequest->student_id, 'Your borrow request for ' . $borrowRequest->equipment->name . ' has been rejected.');

        return back()->with('success', 'Borrow request rejected.');
    }

    public function staffReadyToClaim(Request $request, int $request_id)
    {
        $this->authorizeStaff();

        $borrowRequest = BorrowRequest::findOrFail($request_id);
        if ($borrowRequest->status !== 'approved') {
            return back()->with('error', 'Request must be approved before it can be marked ready to claim.');
        }

        $borrowRequest->update(['status' => 'ready_to_claim']);
        $this->notifyUser((int) $borrowRequest->student_id, 'Your equipment request for ' . $borrowRequest->equipment->name . ' is ready to claim.');

        return back()->with('success', 'Borrow request marked ready to claim.');
    }

    public function staffMarkClaimed(Request $request, int $request_id)
    {
        $this->authorizeStaff();

        $borrowRequest = BorrowRequest::findOrFail($request_id);
        if ($borrowRequest->status !== 'ready_to_claim') {
            return back()->with('error', 'Request must be ready to claim before it can be marked as claimed.');
        }

        $quantity = $borrowRequest->quantity;
        $equipment = $borrowRequest->equipment;

        if ($quantity > ($equipment->available_quantity ?? 0)) {
            return back()->with('error', 'Cannot claim: insufficient available quantity.');
        }

        $equipment->decrement('available_quantity', $quantity);
        $borrowRequest->update([
            'status' => 'claimed',
            'claimed_at' => now(),
        ]);

        $this->notifyUser((int) $borrowRequest->student_id, 'Your equipment request for ' . $equipment->name . ' has been marked as claimed.');

        return back()->with('success', 'Equipment marked as claimed.');
    }

    public function staffApproveReturn(Request $request, int $request_id, DatabaseManager $db)
    {
        $this->authorizeStaff();

        $borrowRequest = BorrowRequest::query()->with('equipment', 'student')->findOrFail($request_id);
        if ($borrowRequest->status !== 'return_requested') {
            return back()->with('error', 'This request has not been marked for return.');
        }

        $db->transaction(function () use ($borrowRequest) {
            $borrowRequest->equipment->increment('available_quantity', $borrowRequest->quantity);
            $borrowRequest->update([
                'status' => 'returned',
                'returned_at' => now(),
            ]);
        });

        $this->notifyUser((int) $borrowRequest->student_id, 'Your return request for ' . $borrowRequest->equipment->name . ' has been approved and completed.');

        return back()->with('success', 'Return approved and inventory updated.');
    }

    public function staffRejectReturn(Request $request, int $request_id)
    {
        $this->authorizeStaff();

        $borrowRequest = BorrowRequest::query()->with('equipment')->findOrFail($request_id);
        if ($borrowRequest->status !== 'return_requested') {
            return back()->with('error', 'No return request exists for this borrowing.');
        }

        $borrowRequest->update([
            'status' => 'claimed',
            'remarks' => $request->input('remarks', 'Return request rejected by staff.'),
        ]);

        $this->notifyUser((int) $borrowRequest->student_id, 'Your return request for ' . $borrowRequest->equipment->name . ' was rejected. Please speak with staff.');

        return back()->with('success', 'Return request rejected.');
    }

    public function staffMarkReturned(Request $request, int $request_id, DatabaseManager $db)
    {
        $this->authorizeStaff();

        $borrowRequest = BorrowRequest::query()->with('equipment', 'student')->findOrFail($request_id);
        if (!in_array($borrowRequest->status, ['claimed', 'return_requested', 'overdue'], true)) {
            return back()->with('error', 'This borrowing cannot be marked returned at this stage.');
        }

        $db->transaction(function () use ($borrowRequest, $request) {
            $borrowRequest->equipment->increment('available_quantity', $borrowRequest->quantity);
            $borrowRequest->update([
                'status' => 'returned',
                'returned_at' => now(),
                'remarks' => $request->input('remarks', 'Return processed by staff.'),
            ]);
        });

        $this->notifyUser((int) $borrowRequest->student_id, 'Your borrowing for ' . $borrowRequest->equipment->name . ' has been marked as returned.');

        return back()->with('success', 'Equipment return completed successfully.');
    }

    public function allBorrows(Request $request)
    {
        $role = Auth::user()->role ?? null;
        if (!in_array($role, ['admin', 'staff'], true)) {
            abort(403);
        }

        $this->syncOverdueStatuses();

        $requests = BorrowRequest::query()
            ->with(['student', 'equipment', 'approvedBy'])
            ->when($request->query('status'), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->query('q'), function ($query, $term) {
                $term = '%' . trim($term) . '%';
                return $query->where(function ($sub) use ($term) {
                    $sub->whereHas('student', function ($q) use ($term) {
                        $q->where('name', 'like', $term);
                    })
                        ->orWhereHas('equipment', function ($q) use ($term) {
                            $q->where('name', 'like', $term);
                        })
                        ->orWhere('purpose', 'like', $term);
                });
            })
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

    /*
     * Authorizers + helpers
     */
    private function authorizeStaff(): void
    {
        $role = Auth::user()->role ?? null;
        if (!in_array($role, ['staff', 'admin'], true)) {
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

    private function authorizeStudentOnly(): void
    {
        $role = Auth::user()->role ?? null;
        if (in_array($role, ['staff', 'admin'], true)) {
            abort(403);
        }
    }

    private function syncOverdueStatuses(): void
    {
        if (!Schema::hasColumn('borrow_requests', 'return_date')) {
            return;
        }

        $overdueRequests = BorrowRequest::query()
            ->whereIn('status', ['approved', 'ready_to_claim', 'claimed', 'return_requested'])
            ->whereNotNull('return_date')
            ->whereDate('return_date', '<', now()->toDateString())
            ->get();

        foreach ($overdueRequests as $request) {
            $request->update(['status' => 'overdue']);
            $this->notifyUser(
                (int) $request->student_id,
                'Your borrow request for ' . $request->equipment->name . ' is overdue. Please return it immediately.'
            );
        }
    }

    private function notifyStaff(string $message, string $type = 'info', ?int $reference_id = null, ?string $reference_type = null, ?string $action_url = null, ?string $title = null): void
    {
        $staffUsers = \App\Models\User::whereIn('role', ['staff', 'admin'])->get();
        foreach ($staffUsers as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => $title ?? 'New Notification',
                'message' => $message,
                'type' => $type,
                'reference_id' => $reference_id,
                'reference_type' => $reference_type,
                'action_url' => $action_url,
            ]);
        }
    }

    private function notifyUser(int $userId, string $message, string $type = 'info', ?int $reference_id = null, ?string $reference_type = null, ?string $action_url = null, ?string $title = null): void
    {
        // FK integrity safeguard: only create notification if user exists in the same DB.
        if (!\App\Models\User::query()->where('id', $userId)->exists()) {
            return;
        }

        Notification::create([
            'user_id' => $userId,
            'title' => $title ?? 'New Notification',
            'message' => $message,
            'type' => $type,
            'reference_id' => $reference_id,
            'reference_type' => $reference_type,
            'action_url' => $action_url,
        ]);
    }
}

