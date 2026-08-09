@extends('layouts.host')
@section('title', 'Host Dashboard - VoteTune')
@section('header', 'Host Dashboard')
@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <x-card>
            <div class="card-body">
                <h5 class="vt-h5 mb-3">Create New Room</h5>
                <form action="{{ route('host.room.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Room Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required placeholder="e.g. Friday Night Party">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn vt-btn vt-btn-primary w-100">
                        <i data-lucide="plus" class="me-2" style="width: 18px;"></i> Create Room
                    </button>
                </form>
            </div>
        </x-card>
    </div>
    
    <div class="col-md-8">
        <x-card>
            <div class="card-body">
                <h5 class="vt-h5 mb-3">Your Rooms</h5>
                @if($rooms->isEmpty())
                    <p class="text-muted vt-body-medium">You haven't created any rooms yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                <tr>
                                    <td class="fw-medium">{{ $room->name }}</td>
                                    <td><span class="badge bg-secondary font-monospace fs-6">{{ $room->room_code }}</span></td>
                                    <td>
                                        @if($room->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('host.room.show', $room->room_code) }}" class="btn btn-sm btn-outline-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </x-card>
    </div>
</div>
@endsection
