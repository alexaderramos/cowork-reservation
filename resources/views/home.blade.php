@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1>Welcome{{ auth()->user()->name ? ', ' . auth()->user()->name : '' }}!</h1>
        <p class="lead">Manage your reservations and access all available features.</p>
    </div>
    <div class="row text-center mb-5">
        @client
            <div class="col-md-6 mb-3">
                <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-calendar-plus me-2"></i> Create a New Reservation
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary btn-lg w-100">
                    <i class="bi bi-calendar-check me-2"></i> View My Reservations
                </a>
            </div>
        @endclient
        @admin
            <div class="col-md-4 mb-3">
                <a href="{{ route('rooms.index') }}" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-building me-2"></i> Manage Rooms
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary btn-lg w-100">
                    <i class="bi bi-calendar-check me-2"></i> View All Reservations
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('rooms.create') }}" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-plus-circle me-2"></i> Create a New Room
                </a>
            </div>
        @endadmin
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alerts</div>

                <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @else
                    <div class="alert alert-success" role="alert">
                        Everything is working correctly!
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
