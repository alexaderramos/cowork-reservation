@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <x-breadcrumb :links="[
            ['url' => route('home'), 'label' => 'Home'],
            ['url' => '#', 'label' => 'Rooms'],
        ]"/>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold"><i class="bi bi-building me-2"></i> Rooms List</h1>
            <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-2"></i> Create a New Room
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm card-room">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="card-text">{{ $room->description }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
