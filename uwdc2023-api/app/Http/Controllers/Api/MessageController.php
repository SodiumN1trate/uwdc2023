<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Events\MessageEvent;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MessageResource::collection(Message::where('zone_id', auth()->user()->zone_id)->get());
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
        error_log($message->zone_id);
        broadcast(new MessageEvent($message->id, $message->zone_id));
        return response()->json($message);
    }

}
