@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservas</h1>

        @client
            <a href="{{ route('reservations.create') }}" class="btn btn-primary">Hacer una Reserva</a>
        @endclient

        @admin
            <form action="{{ route('reservations.index') }}" method="GET" class="mb-4">
                <div class="form-group">
                    <label for="room_id">Filtrar por Sala</label>
                    <select name="room_id" id="room_id" class="form-control" onchange="this.form.submit()">
                        <option value="">Todas las Salas</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        @endadmin

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Sala</th>
                    <th>Usuario</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Estado</th>
                    @admin
                        <th>Acciones</th>
                    @endadmin
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->room->name }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>@datetime($reservation->start_time)</td>
                        <td>@datetime($reservation->end_time)</td>
                        <td>{{ $reservation->status }}</td>
                        @admin
                            <td>
                                <form action="{{ route('reservations.updateStatus', $reservation->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ $reservation->status == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        @endadmin
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
