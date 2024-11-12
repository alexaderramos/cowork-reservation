@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <x-breadcrumb :links="[
            ['url' => route('home'), 'label' => 'Home'],
            ['url' => route('reservations.index'), 'label' => 'Reservations'],
            ['url' => '#', 'label' => 'Create']
        ]"/>


        <h1 class="fw-bold mb-4"><i class="bi bi-calendar-plus me-2"></i> Create a Reservation</h1>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm p-4">
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="room_id" class="form-label">Room</label>
                    <select name="room_id" id="room_id" class="form-select @error('room_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Select a room</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <span class="invalid-feedback"><i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="start_time" class="form-label">Date and Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" required>
                    @error('start_time')
                        <span class="invalid-feedback"><i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-check-circle me-2"></i> Reserve
                </button>
            </form>
        </div>
    </div>
@endsection
