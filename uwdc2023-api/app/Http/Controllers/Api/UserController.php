<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
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

        $user = User::create($validated);
        return new UserResource($user);
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
        return new UserResource($user);
    }

}
