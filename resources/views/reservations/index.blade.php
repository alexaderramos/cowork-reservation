@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <x-breadcrumb :links="[
            ['url' => route('home'), 'label' => 'Home'],
            ['url' => '#', 'label' => 'Reservations'],
        ]"/>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold"><i class="bi bi-calendar4-week me-2"></i> Reservations</h1>
            @client
                <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-calendar-plus me-2"></i> Create a Reservation
                </a>
            @endclient
        </div>

        <!-- Filtro para Administradores -->
        @admin
            <form action="{{ route('reservations.index') }}" method="GET" class="mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="room_id" class="form-label">Filter by Room</label>
                    </div>
                    <div class="col-auto">
                        <select name="room_id" id="room_id" class="form-select" onchange="this.form.submit()">
                            <option value="">All Rooms</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        @endadmin

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabla de Reservas -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-bordered table-striped m-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Room</th>
                            <th scope="col">User</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                            @admin
                                <th scope="col" class="text-center">Actions</th>
                            @endadmin
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->room->name }}</td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->start_time->format('d/m/Y H:i') }}</td>
                                <td>{{ $reservation->end_time->format('d/m/Y H:i') }}</td>
                                <td>
                                    @switch($reservation->status)
                                        @case(\App\Enums\Reservation\StatusEnum::ACCEPTED->value)
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> {{ ucfirst($reservation->status) }}</span>
                                            @break
                                        @case(\App\Enums\Reservation\StatusEnum::PENDING->value)
                                            <span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i> {{ ucfirst($reservation->status) }}</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ ucfirst($reservation->status) }}</span>
                                    @endswitch
                                </td>
                                @admin
                                    <td class="text-center">
                                        <form action="{{ route('reservations.updateStatus', $reservation->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status }}" {{ $reservation->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                @endadmin
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No reservations available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
              {{ $reservations->links() }}
        </div>
    </div>
@endsection
