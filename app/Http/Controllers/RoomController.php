<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\RoomStoreRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request): RedirectResponse
    {
        $room = Room::create($request->validated());

        return redirect()->route('rooms.index')->with('success', 'Sala creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): View
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room): View
    {
        return view('rooms.create', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomUpdateRequest $request, Room $room): RedirectResponse
    {
        $room->update($request->validated());

        return redirect()->route('rooms.index')->with('success', 'Sala actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room): RedirectResponse
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Sala eliminada exitosamente');
    }
}
