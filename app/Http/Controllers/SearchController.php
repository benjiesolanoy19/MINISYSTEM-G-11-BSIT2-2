<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Laboratory;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Global search across equipment, labs, users, and borrowings
     */
    public function global(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'equipment' => [],
                'laboratories' => [],
                'users' => [],
                'borrowings' => [],
            ]);
        }

        // Search Equipment
        $equipment = Equipment::where('asset_tag', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'type' => 'equipment',
                    'title' => $item->name,
                    'subtitle' => $item->asset_tag . ' - ' . $item->category,
                    'icon' => 'fas fa-laptop',
                    'url' => route('equipment.show', $item->id),
                ];
            });

        // Search Laboratories
        $laboratories = Laboratory::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('location', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'type' => 'laboratory',
                    'title' => $item->name,
                    'subtitle' => $item->location ?? 'No location',
                    'icon' => 'fas fa-flask',
                    'url' => route('laboratory.show', $item->id) ?? '#',
                ];
            });

        // Search Users (staff only can see user search results)
        $users = collect();
        if (auth()->user() && auth()->user()->role === 'staff' || auth()->user()->role === 'admin') {
            $users = User::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('student_id', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'type' => 'user',
                        'title' => $item->name,
                        'subtitle' => $item->email,
                        'icon' => 'fas fa-user',
                        'url' => route('profile.index', ['id' => $item->id]) ?? '#',
                    ];
                });
        }

        // Search Borrowings (staff/admin only)
        $borrowings = collect();
        if (auth()->user() && (auth()->user()->role === 'staff' || auth()->user()->role === 'admin')) {
            $borrowings = Borrowing::whereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
                ->orWhereHas('equipment', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'type' => 'borrowing',
                        'title' => $item->equipment->name ?? 'Unknown Equipment',
                        'subtitle' => 'by ' . $item->user->name ?? 'Unknown User',
                        'icon' => 'fas fa-hand-holding-box',
                        'url' => route('borrowings.index') ?? '#',
                    ];
                });
        }

        return response()->json([
            'equipment' => $equipment->values(),
            'laboratories' => $laboratories->values(),
            'users' => $users->values(),
            'borrowings' => $borrowings->values(),
        ]);
    }

    /**
     * Search equipment only
     */
    public function equipment(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        $results = Equipment::where('asset_tag', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->limit(20)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'asset_tag' => $item->asset_tag,
                    'category' => $item->category,
                    'status' => $item->status,
                    'url' => route('equipment.show', $item->id),
                ];
            });

        return response()->json(['results' => $results->values()]);
    }
}
