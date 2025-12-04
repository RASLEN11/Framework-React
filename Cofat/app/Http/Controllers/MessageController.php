<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = auth()->user()->messages()->latest()->get();
        return view('user.messages', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
}