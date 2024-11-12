<?php

namespace App\Http\Controllers;

use App\Enums\Reservation\StatusEnum as ReservationStatusEnum;
use App\Http\Requests\Reservation\ReservationChangeStatusRequest;
use App\Http\Requests\Reservation\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Room;
use App\Services\ReservationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(
        ReservationService $reservationService
    ) {
        $this->reservationService = $reservationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $rooms = Room::all();
        $statuses = ReservationStatusEnum::values();
        $reservations = $this->reservationService->getReservations($request->room_id, auth()->user());

        return view('reservations.index', compact('reservations', 'rooms', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $rooms = Room::all();

        return view('reservations.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (! $this->reservationService->checkAvailability($data['room_id'], $data['start_time'])) {
            return redirect()->route('reservations.create')->with('error', 'The room is not available at the selected time.');
        }

        $this->reservationService->storeReservation($data);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * Update the status of the reservation.
     */
    public function updateStatus(ReservationChangeStatusRequest $request, Reservation $reservation): RedirectResponse
    {
        $reservation->status = $request->validated()['status'];
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation status updated.');
    }
}
