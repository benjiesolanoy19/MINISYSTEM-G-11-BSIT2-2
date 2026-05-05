<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class LogController extends Controller
{
    public function timein()
    {
        return redirect()->route('logs.index');
    }

    public function timeout()
    {
        return redirect()->route('logs.index');
    }

    public function storeTimein()
    {
        return $this->handleTimeIn();
    }

    public function storeTimeout()
    {
        return $this->handleTimeOut();
    }

    public function handleTimeIn()
    {
        $lastLog = Log::where('user_id', Auth::id())
            ->orderBy('timestamp', 'desc')
            ->first();

        // Check if already timed in today
        if ($lastLog && $lastLog->type === 'time_in' && $lastLog->timestamp->isToday()) {
            return back()->with('error', 'You have already timed in today!');
        }

        Log::create([
            'user_id' => Auth::id(),
            'type' => 'time_in',
            'timestamp' => now(),
        ]);

        return back()->with('success', 'Time in recorded successfully!');
    }

    public function handleTimeOut()
    {
        $lastLog = Log::where('user_id', Auth::id())
            ->orderBy('timestamp', 'desc')
            ->first();

        // Check if there's a time in without time out
        if (!$lastLog || $lastLog->type !== 'time_in' || !$lastLog->timestamp->isToday()) {
            return back()->with('error', 'No time in record found for today!');
        }

        // Check if already timed out
        $lastTimeOut = Log::where('user_id', Auth::id())
            ->where('type', 'time_out')
            ->orderBy('timestamp', 'desc')
            ->first();

        if ($lastTimeOut && $lastTimeOut->timestamp->isToday()) {
            return back()->with('error', 'You have already timed out today!');
        }

        Log::create([
            'user_id' => Auth::id(),
            'type' => 'time_out',
            'timestamp' => now(),
        ]);

        return back()->with('success', 'Time out recorded successfully!');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdminOrStaff()) {
            $logs = Log::with('user')->orderBy('timestamp', 'desc')->get();
        } else {
            $logs = Log::where('user_id', $user->id)->orderBy('timestamp', 'desc')->get();
        }
        
        return view('logs.list', compact('logs'));
    }
}
