@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <x-breadcrumb :links="[
            ['url' => route('home'), 'label' => 'Home'],
            ['url' => route('rooms.index'), 'label' => 'Rooms'],
            ['url' => '#', 'label' => isset($room) ? 'Edit Room' : 'Create Room'],
        ]"/>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">{{ isset($room) ? 'Edit Room' : 'Create Room' }}</h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ isset($room) ? route('rooms.update', $room->id) : route('rooms.store') }}" method="POST">
                    @csrf
                    @if(isset($room))
                        @method('PUT')
                    @endif

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $room->name ?? '') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                  rows="4">{{ old('description', $room->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-2"></i> Save
                    </button>
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary ms-2">
                        <i class="bi bi-arrow-left-circle me-2"></i> Back
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
