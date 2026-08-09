@extends('layouts.host')
@section('title', 'Host Dashboard - VoteTune')
@section('header', 'Dashboard')
@section('content')

<!-- Quick Actions & Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <x-card class="h-100 bg-primary text-white border-0 shadow-sm" style="background: linear-gradient(135deg, var(--bs-primary), #4f46e5);">
            <div class="card-body d-flex flex-column justify-content-center text-center py-4">
                <i data-lucide="plus-circle" style="width: 48px; height: 48px; margin: 0 auto 15px auto; opacity: 0.9;"></i>
                <h5 class="fw-bold mb-3">Host a New Event</h5>
                <button type="button" class="btn btn-light w-100 fw-semibold text-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                    Create Room
                </button>
            </div>
        </x-card>
    </div>
    <div class="col-md-3">
        <x-statistic-card title="Total Rooms" value="{{ number_format($stats['total_rooms']) }}" icon="music" />
    </div>
    <div class="col-md-3">
        <x-statistic-card title="Active Rooms" value="{{ number_format($stats['active_rooms']) }}" icon="activity" />
    </div>
    <div class="col-md-3">
        <x-statistic-card title="Total Votes Received" value="{{ number_format($stats['total_votes']) }}" icon="heart" />
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <x-card>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="vt-h5 mb-0">Your Rooms</h5>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal">New Room</button>
                </div>
                
                @if($rooms->isEmpty())
                    <x-empty-state 
                        icon="music-4" 
                        title="No rooms yet" 
                        description="Create your first room to let your audience vote on songs!" 
                    />
                @else
                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead>
                                <tr>
                                    <th>Room Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                <tr>
                                    <td class="fw-bold">{{ $room->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-secondary font-monospace fs-6">{{ $room->room_code }}</span>
                                            <button class="btn btn-sm btn-link p-0 text-muted" onclick="navigator.clipboard.writeText('{{ $room->room_code }}'); App.toast.success('Copied', 'Room code copied to clipboard!');" title="Copy code">
                                                <i data-lucide="copy" style="width: 14px; height: 14px;"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        @if($room->status === 'active')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill d-inline-flex align-items-center gap-1">
                                                <span class="spinner-grow spinner-grow-sm text-success" role="status" style="width: 10px; height: 10px;"></span>
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2 rounded-pill">Closed</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ $room->created_at->diffForHumans() }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('host.room.show', $room->room_code) }}" class="btn btn-sm vt-btn vt-btn-primary">
                                            Open Dashboard
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

<!-- Create Room Modal -->
<div class="modal fade" id="createRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('host.room.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Create New Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Room Name</label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" required placeholder="e.g. Friday Night Party" autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="form-text text-muted mt-2">Give your room a memorable name. Your audience will see this.</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn vt-btn vt-btn-primary px-4">Create Room</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
