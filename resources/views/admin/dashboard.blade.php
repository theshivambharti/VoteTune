@extends('layouts.admin')
@section('title', 'Overview - Admin Dashboard')
@section('header', 'Overview')
@section('content')
<div class="row g-4">
    <div class="col-12 mb-4">
        <h4 class="vt-h4 mb-1">Welcome back, {{ auth()->user()->name }}</h4>
        <p class="text-muted vt-body-medium">Here's what's happening with VoteTune today.</p>
    </div>

    <!-- Stats row -->
    <div class="col-md-4 col-sm-6">
        <x-statistic-card title="Total Users" value="{{ number_format($stats['users']) }}" icon="users" color="primary" />
    </div>
    <div class="col-md-4 col-sm-6">
        <x-statistic-card title="Total Hosts" value="{{ number_format($stats['hosts']) }}" icon="mic-2" color="info" />
    </div>
    <div class="col-md-4 col-sm-6">
        <x-statistic-card title="Total Rooms" value="{{ number_format($stats['rooms']) }}" icon="music" color="success" />
    </div>
    <div class="col-md-4 col-sm-6">
        <x-statistic-card title="Active Rooms" value="{{ number_format($stats['active_rooms']) }}" icon="activity" color="warning" />
    </div>
    <div class="col-md-4 col-sm-6">
        <x-statistic-card title="Total Songs" value="{{ number_format($stats['songs']) }}" icon="disc" color="secondary" />
    </div>
    <div class="col-md-4 col-sm-6">
        <x-statistic-card title="Total Votes" value="{{ number_format($stats['votes']) }}" icon="heart" color="danger" />
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-12">
        <x-card>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="vt-h5 mb-0">Recent Rooms</h5>
                    <a href="{{ route('admin.rooms') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                
                @if($recentRooms->isEmpty())
                    <p class="text-muted vt-body-medium">No rooms have been created yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Host</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentRooms as $room)
                                <tr>
                                    <td class="fw-medium">{{ $room->name }}</td>
                                    <td><span class="badge bg-secondary font-monospace fs-6">{{ $room->room_code }}</span></td>
                                    <td>{{ $room->user->name ?? 'Unknown' }}</td>
                                    <td>
                                        @if($room->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">{{ $room->created_at->diffForHumans() }}</td>
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
