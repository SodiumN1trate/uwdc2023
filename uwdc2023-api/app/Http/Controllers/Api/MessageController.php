<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return MessageResource::collection(Message::where('zone_id', $user->zone_id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'zone_id' => 'required|integer',
            'message' => 'required|max:255',
        ]);
        $message = Message::create($validated);
        return response()->json($message);
    }
}
