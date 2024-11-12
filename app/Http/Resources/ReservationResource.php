<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'room_id' => $this->room_id,
            'user_id' => $this->user_id,
            'start_time_value' => Carbon::parse($this->start_time)->format('d/m/Y h:i a'),
            'end_time_value' => Carbon::parse($this->end_time)->format('d/m/Y h:i a'),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'room' => RoomResource::make($this->whenLoaded('room')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
