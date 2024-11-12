@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hacer una Reserva</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="room_id">Sala</label>
                <select name="room_id" class="form-control @error('room_id') is-invalid @enderror" required>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
                @error('room_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="start_time">Fecha y Hora</label>
                <input type="datetime-local" name="start_time" class="form-control @error('start_time') is-invalid @enderror" required>
                @error('start_time')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mt-3">Reservar</button>
        </form>
    </div>
@endsection
