<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BorrowRequest;
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

        $this->syncOverdueStatuses();

        if (in_array($user->role, ['staff', 'admin'])) {
            $borrowings = BorrowRequest::with(['student', 'equipment'])
                ->orderBy('request_date', 'desc')
                ->limit(10)
                ->get();

            $pendingApprovals = BorrowRequest::where('status', 'pending')->count();
            $activeBorrowings = BorrowRequest::whereIn('status', ['approved', 'ready_to_claim', 'claimed', 'return_requested'])->count();
            $overdueEquipment = BorrowRequest::where('status', 'overdue')->count();
            $returnRequests = BorrowRequest::where('status', 'return_requested')->count();
        } else {
            $borrowings = BorrowRequest::where('student_id', $user->id)
                ->orderBy('request_date', 'desc')
                ->limit(10)
                ->get();

            $pendingApprovals = BorrowRequest::where('student_id', $user->id)->where('status', 'pending')->count();
            $activeBorrowings = BorrowRequest::where('student_id', $user->id)
                ->whereIn('status', ['approved', 'ready_to_claim', 'claimed', 'return_requested'])
                ->count();
            $overdueEquipment = BorrowRequest::where('student_id', $user->id)->where('status', 'overdue')->count();
            $returnRequests = BorrowRequest::where('student_id', $user->id)->where('status', 'return_requested')->count();
        }

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

        $totalEquipment = Equipment::count();
        $availableEquipment = Equipment::where('status', 'available')->count();
        $borrowedEquipment = Equipment::where('status', 'borrowed')->count();
        $activeUsers = User::whereIn('role', ['student', 'staff', 'admin'])->count();
        $incidentReports = Incident::count();

        $equipmentBorrowTrend = BorrowRequest::selectRaw("MONTH(request_date) as month_num, DATE_FORMAT(request_date, '%b') as month_label, count(*) as total")
            ->whereNotNull('request_date')
            ->where('request_date', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month_num', 'month_label')
            ->orderBy('month_num')
            ->get();

        $incidentTrend = Incident::selectRaw("MONTH(created_at) as month_num, DATE_FORMAT(created_at, '%b') as month_label, count(*) as total")
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month_num', 'month_label')
            ->orderBy('month_num')
            ->get();

        $popularEquipment = BorrowRequest::selectRaw('equipment_id, count(*) as total')
            ->whereNotNull('equipment_id')
            ->groupBy('equipment_id')
            ->orderByDesc('total')
            ->limit(5)
            ->with('equipment')
            ->get();

        $borrowTrendLabels = $equipmentBorrowTrend->pluck('month_label')->all();
        $borrowTrendData = $equipmentBorrowTrend->pluck('total')->all();
        $incidentTrendLabels = $incidentTrend->pluck('month_label')->all();
        $incidentTrendData = $incidentTrend->pluck('total')->all();
        $popularEquipmentList = $popularEquipment->map(function ($item) {
            return [
                'name' => optional($item->equipment)->name ?? 'Unknown',
                'count' => $item->total,
            ];
        })->all();

        $reasonMessage = 'System running smoothly — keep equipment moving safely.';

        return view('dashboard.home', compact(
            'user',
            'borrowings',
            'logs',
            'incidents',
            'notifications',
            'unreadCount',
            'pendingApprovals',
            'activeBorrowings',
            'overdueEquipment',
            'returnRequests',
            'totalEquipment',
            'availableEquipment',
            'borrowedEquipment',
            'activeUsers',
            'incidentReports',
            'borrowTrendLabels',
            'borrowTrendData',
            'incidentTrendLabels',
            'incidentTrendData',
            'popularEquipmentList',
            'reasonMessage'
        ));
    }

    private function syncOverdueStatuses(): void
    {
        // Prevent 500s if the DB schema doesn't contain the expected column.
        // Some deployments may have diverged migrations.
        if (!\Schema::hasColumn('borrow_requests', 'return_date')) {
            return;
        }

        BorrowRequest::whereIn('status', ['approved', 'ready_to_claim', 'claimed', 'return_requested'])
            ->whereNotNull('return_date')
            ->whereDate('return_date', '<', now()->toDateString())
            ->update(['status' => 'overdue']);
    }

    


    public function main()

    {
        $user = Auth::user();
        
        // Limit queries to improve performance
        $borrowings = BorrowRequest::where('student_id', $user->id)
            ->orderBy('request_date', 'desc')
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
            
        return view('dashboard.home', compact('user', 'borrowings', 'logs', 'incidents', 'notifications', 'unreadCount'));
    }
}
