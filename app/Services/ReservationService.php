<?php

namespace App\Services;

use App\Enums\User\RoleEnum;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReservationService
{
    /**
     * Get reservations by user role.
     */
    public function getReservations($roomId, User $user): Collection
    {
        if ($user->role === RoleEnum::ADMIN->value) {
            return Reservation::when($roomId, function ($query) use ($roomId) {
                return $query->where('room_id', $roomId);
            })->get();
        }

        return Reservation::where('user_id', $user->id)->get();
    }

    /**
     * Check if the room is available at the given time.
     */
    public function checkAvailability($roomId, $startTime): bool
    {
        $start = Carbon::parse($startTime);
        $end = $start->copy()->addHour();

        return ! Reservation::where('room_id', $roomId)
            ->where(function ($query) use ($start, $end) {
                $query->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->exists();
    }

    /**
     * Store a new reservation.
     */
    public function storeReservation(array $data): Reservation
    {
        return Reservation::create([
            ...$data,
            'user_id' => auth()->user()->id,
            'end_time' => Carbon::parse($data['start_time'])->addHour(),
        ]);
    }
}