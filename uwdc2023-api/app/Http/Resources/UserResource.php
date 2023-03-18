<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar,
            'x' => $this->x,
            'y' => $this->y,
            'zone_id' => $this->zone_id,
            'created_at' => (new DateTime($this->created_at))->diff((new DateTime(now())))->format('%h hours %i minutes'),
        ];
    }
}
