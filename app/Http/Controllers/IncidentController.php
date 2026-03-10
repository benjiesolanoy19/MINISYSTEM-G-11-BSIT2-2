<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Incident;
use App\Models\Equipment;
use App\Models\Notification;

class IncidentController extends Controller
{
    public function create()
    {
        $equipment = Equipment::all();
        return view('incidents.report', compact('equipment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'nullable|exists:equipment,id',
            'description' => 'required|string',
        ]);

        $incident = Incident::create([
            'user_id' => Auth::id(),
            'equipment_id' => $validated['equipment_id'] ?? null,
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        // Notify staff
        $this->notifyStaff('New incident report from ' . Auth::user()->name);

        return redirect()->route('incidents.list')->with('success', 'Incident reported successfully!');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdminOrStaff()) {
            $incidents = Incident::with('user', 'equipment')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $incidents = Incident::where('user_id', $user->id)
                ->with('equipment')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('incidents.list', compact('incidents'));
    }

    public function manage()
    {
        $incidents = Incident::with('user', 'equipment')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('incidents.manage', compact('incidents'));
    }

    public function updateStatus(Request $request, Incident $incident)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,investigating,resolved,closed',
            'resolution' => 'nullable|string',
        ]);

        $incident->update($validated);

        Notification::create([
            'user_id' => $incident->user_id,
            'message' => 'Your incident report status has been updated to: ' . $validated['status'],
            'type' => 'info',
        ]);

        return back()->with('success', 'Incident status updated!');
    }

    private function notifyStaff($message)
    {
        $staff = \App\Models\User::whereIn('role', ['admin', 'staff'])->get();
        foreach ($staff as $user) {
            Notification::create([
                'user_id' => $user->id,
                'message' => $message,
                'type' => 'warning',
            ]);
        }
    }
}
