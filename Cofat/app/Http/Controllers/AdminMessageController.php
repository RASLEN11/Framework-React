<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMessageController extends Controller
{
    public function index(Request $request)
    {
        // Get the IDs of the latest messages for each user
        $latestMessageIds = Message::select(DB::raw('MAX(id) as id'))
            ->groupBy('user_id')
            ->pluck('id');

        // Base query for messages
        $query = Message::with('user')
            ->whereIn('id', $latestMessageIds)
            ->latest();

        // Add search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->whereHas('user', function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        // Paginate the results
        $messages = $query->paginate(10)->withQueryString();

        return view('admin.messages', compact('messages'));
    }

    public function getUserMessages(User $user)
    {
        $messages = $user->messages()->with(['user', 'admin'])->latest()->get();
        return response()->json([
            'messages' => $messages,
            'has_unread' => $user->messages()->where('is_replied', false)->exists()
        ]);
    }

    public function reply(Request $request, Message $message)
    {
        try {
            $request->validate([
                'reply' => 'required|string|max:1000',
                'user_id' => 'required|exists:users,id'
            ]);

            $replyMessage = Message::create([
                'user_id' => $request->user_id,
                'message' => $request->reply,
                'admin_id' => auth()->id(),
                'is_replied' => true
            ]);

            return response()->json([
                'success' => true,
                'message' => $replyMessage
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteUserMessages(User $user)
    {
        try {
            $user->messages()->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function markAsRead(User $user)
    {
        try {
            $user->messages()->where('is_replied', false)->update(['is_replied' => true]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getUnrepliedCount()
    {
        try {
            $count = Message::where('is_replied', false)->count();
            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}