<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BugReport;
use App\Models\Notification;
use App\Models\User;
use App\Models\Message;

class BugReportController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user && $user->isAdmin()) {
            return redirect()->route('bug-reports.index');
        }

        $myReports = BugReport::where('reporter_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bug_reports.create', compact('myReports'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:2000',
            'screenshot' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
            'affected_page' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high,critical',
        ]);

        $screenshotPath = null;
        if ($request->hasFile('screenshot')) {
            $screenshotPath = $request->file('screenshot')->store('bug_screenshots', 'public');
        }

        $bugReport = BugReport::create([
            'reporter_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'screenshot' => $screenshotPath,
            'affected_page' => $validated['affected_page'],
            'priority' => $validated['priority'],
            'status' => 'pending',
        ]);

        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $admin->id,
                'bug_report_id' => $bugReport->id,
                'message' => $bugReport->description,
                'is_read' => false,
            ]);
        }

        $this->notifyAdmins('🔔 New Bug Report submitted by ' . Auth::user()->name . ' — "' . $bugReport->title . '"');

        Notification::create([
            'user_id' => Auth::id(),
            'message' => 'Your bug report "' . $bugReport->title . '" has been submitted and is now in the support queue.',
            'type' => 'success',
        ]);

        return redirect()->route('bug-reports.show', $bugReport)->with('success', 'Bug report submitted successfully. An administrator has been notified.');
    }

    public function index()
    {
        $bugReports = BugReport::with(['reporter', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bug_reports.index', compact('bugReports'));
    }

    public function show(BugReport $bug_report)
    {
        $current = Auth::user();

        if (! $this->canViewBugReport($current, $bug_report)) {
            abort(403);
        }

        $messages = Message::where('bug_report_id', $bug_report->id)
            ->orderBy('created_at')
            ->get();

        Message::where('bug_report_id', $bug_report->id)
            ->where('receiver_id', $current->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $staffMembers = User::where('role', 'staff')->orderBy('name')->get();

        return view('bug_reports.show', compact('bug_report', 'messages', 'staffMembers'));
    }

    public function comment(Request $request, BugReport $bug_report)
    {
        $current = Auth::user();

        if (! $this->canViewBugReport($current, $bug_report)) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('message_attachments', 'public');
        }

        $receiverId = $current->id === $bug_report->reporter_id
            ? ($bug_report->assigned_to ?? User::where('role', 'admin')->first()->id ?? $current->id)
            : $bug_report->reporter_id;

        $message = Message::create([
            'sender_id' => $current->id,
            'receiver_id' => $receiverId,
            'bug_report_id' => $bug_report->id,
            'message' => $validated['message'],
            'attachment' => $attachmentPath,
            'is_read' => false,
        ]);

        if ($receiverId !== $current->id) {
            Notification::create([
                'user_id' => $receiverId,
                'message' => 'New update on Bug Report #' . $bug_report->id . ' from ' . $current->name,
                'type' => 'bug',
            ]);
        }

        return back()->with('success', 'Comment added to the ticket thread.');
    }

    public function assign(Request $request, BugReport $bug_report)
    {
        $current = Auth::user();

        if (! $current->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $staff = User::where('id', $validated['assigned_to'])->where('role', 'staff')->first();
        if (! $staff) {
            return back()->withErrors(['assigned_to' => 'Please assign to a valid staff member.']);
        }

        $bug_report->update(['assigned_to' => $staff->id]);

        Notification::create([
            'user_id' => $staff->id,
            'message' => 'You have been assigned to Bug Report #' . $bug_report->id . '.',
            'type' => 'bug',
        ]);

        Notification::create([
            'user_id' => $bug_report->reporter_id,
            'message' => 'Bug Report #' . $bug_report->id . ' is now assigned to ' . $staff->name . '.',
            'type' => 'bug',
        ]);

        return back()->with('success', 'Ticket assigned successfully.');
    }

    public function update(Request $request, BugReport $bug_report)
    {
        $current = Auth::user();

        if (! $current->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,approved,under_review,in_progress,testing,resolved,closed,rejected',
            'reply' => 'nullable|string|max:1000',
            'admin_reason' => 'nullable|string|max:1000',
        ]);

        $bug_report->update([
            'status' => $validated['status'],
            'reply' => $validated['reply'] ?? $bug_report->reply,
        ]);

        // Notify reporter with contextual message
        $statusLabel = str_replace('_', ' ', ucfirst($validated['status']));

        if ($validated['status'] === 'rejected') {
            $reason = $validated['admin_reason'] ?? 'No reason provided.';
            Notification::create([
                'user_id' => $bug_report->reporter_id,
                'message' => '❌ Your bug report "' . $bug_report->title . '" was rejected. Reason: ' . $reason,
                'type' => 'bug',
            ]);
        } else {
            Notification::create([
                'user_id' => $bug_report->reporter_id,
                'message' => '✅ Your bug report "' . $bug_report->title . '" status has been updated to ' . $statusLabel . '.',
                'type' => 'bug',
            ]);
        }

        return back()->with('success', 'Bug report status updated successfully.');
    }

    private function notifyAdmins(string $message): void
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'message' => $message,
                'type' => 'bug',
            ]);
        }
    }

    private function canViewBugReport(User $user, BugReport $bug_report): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($bug_report->reporter_id === $user->id) {
            return true;
        }

        return $bug_report->assigned_to === $user->id;
    }
}
