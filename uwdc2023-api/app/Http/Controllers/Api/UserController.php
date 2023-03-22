<?php

namespace App\Http\Controllers\Api;

use App\Events\UserMoveEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Message;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'avatar' => 'required',
            'zone_id' => 'integer|sometimes',
            'x' => 'integer|sometimes',
            'y' => 'integer|sometimes',
        ]);

        $zone = Zone::inRandomOrder()->first();
        $validated['zone_id'] = $zone->id;
        $validated['x'] = round($zone->width / 2 + $zone->x - 600);
        $validated['y'] = round($zone->height / 2 + $zone->y - 10);
        $user = User::create($validated);
        return [
                'data' => new UserResource($user),
                'access_token' => $user->createToken('login')->accessToken,
            ];
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'avatar' => 'required',
            'zone_id' => 'integer|sometimes',
            'x' => 'integer|sometimes',
            'y' => 'integer|sometimes',
        ]);
        $user->update($validated);
        broadcast(new UserMoveEvent($user->id));
        return new UserResource($user);
    }

    public function me() {
        return new UserResource(auth()->user());
    }

    public function end() {
        $zoneId = auth()->user()->zone_id;
        auth()->user()->token()->revoke();
        User::find(auth()->user()->id)->delete();
        error_log(count(Zone::find($zoneId)->users));
        if (count(Zone::find($zoneId)->users) === 0) {
            Message::where('zone_id', $zoneId)->delete();
        }
        return true;
    }
}
