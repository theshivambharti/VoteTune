@extends('layouts.admin')
@section('title', 'Rooms - Admin Dashboard')
@section('header', 'Rooms')
@section('content')
<x-card>
    <div class="card-body">
        <h5 class="vt-h5 mb-4">All Rooms</h5>
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Host</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td class="fw-bold">{{ $room->name }}</td>
                        <td><span class="badge bg-secondary font-monospace">{{ $room->room_code }}</span></td>
                        <td>{{ $room->user->name ?? 'Unknown' }}</td>
                        <td>
                            @if($room->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Closed</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $room->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No rooms found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $rooms->links() }}
        </div>
    </div>
</x-card>
@endsection
