<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = trim($request->query('search', ''));

        $sidebarData = $this->prepareSidebarData($user, $search);

        return view('messages.index', array_merge($sidebarData, [
            'search' => $search,
        ]));
    }

    public function show(User $user, Request $request)
    {
        $current = Auth::user();

        if (!$this->canChatWith($current, $user)) {
            abort(403);
        }

        Message::where('sender_id', $user->id)
            ->where('receiver_id', $current->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where(function ($query) use ($current, $user) {
                $query->where('sender_id', $current->id)->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($current, $user) {
                $query->where('sender_id', $user->id)->where('receiver_id', $current->id);
            })
            ->orderBy('created_at')
            ->get();

        $sidebarData = $this->prepareSidebarData($current, $request->query('search', ''));

        return view('messages.show', array_merge($sidebarData, [
            'user' => $user,
            'messages' => $messages,
            'search' => $request->query('search', ''),
        ]));
    }

    public function store(Request $request)
    {
        $current = Auth::user();

        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:2000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        $receiver = User::findOrFail($validated['receiver_id']);

        if (!$this->canChatWith($current, $receiver)) {
            abort(403);
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('message_attachments', 'public');
        }

        Message::create([
            'sender_id' => $current->id,
            'receiver_id' => $receiver->id,
            'message' => $validated['message'],
            'attachment' => $attachmentPath,
            'is_read' => false,
        ]);

        return redirect()->route('messages.show', $receiver->id)->with('success', 'Message sent successfully.');
    }

    private function prepareSidebarData(User $user, string $search = ''): array
    {
        $contacts = User::where('id', '!=', $user->id)
            ->when($user->role === 'student', function ($query) {
                return $query->whereIn('role', ['staff', 'admin']);
            })
            ->when($user->role !== 'student', function ($query) {
                return $query->whereIn('role', ['admin', 'staff', 'student']);
            })
            ->orderBy('name');

        if ($search) {
            $contacts->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $contacts = $contacts->get();

        $previews = [];
        try {
            $latestMessages = Message::where(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                        ->orWhere('receiver_id', $user->id);
                })
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($contacts as $contact) {
                $conversation = $latestMessages->filter(function ($message) use ($user, $contact) {
                    return ($message->sender_id === $user->id && $message->receiver_id === $contact->id)
                        || ($message->sender_id === $contact->id && $message->receiver_id === $user->id);
                });

                $latest = $conversation->first();
                $unread = Message::where('sender_id', $contact->id)
                    ->where('receiver_id', $user->id)
                    ->where('is_read', false)
                    ->count();

                $previews[] = [
                    'contact' => $contact,
                    'latest' => $latest,
                    'unread' => $unread,
                    'preview' => $latest ? Str::limit($latest->message, 65) : 'No conversation yet.',
                    'time' => $latest ? $latest->created_at->diffForHumans() : null,
                ];
            }
        } catch (QueryException $e) {
            $previews = [];
        }

        $admins = collect($previews)->where('contact.role', 'admin')->values();
        $staff = collect($previews)->where('contact.role', 'staff')->values();
        $students = collect($previews)->where('contact.role', 'student')->values();

        return [
            'admins' => $admins,
            'staff' => $staff,
            'students' => $students,
        ];
    }

    private function canChatWith(User $sender, User $receiver): bool
    {
        if ($sender->id === $receiver->id) {
            return false;
        }

        if ($sender->role === 'student') {
            return in_array($receiver->role, ['staff', 'admin']);
        }

        return true;
    }
}
