@extends('layouts.admin')
@section('title', 'Songs - Admin Dashboard')
@section('header', 'Songs')
@section('content')
<x-card>
    <div class="card-body">
        <h5 class="vt-h5 mb-4">All Songs</h5>
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Room</th>
                        <th>Added By</th>
                        <th>Added At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($songs as $song)
                    <tr>
                        <td>{{ $song->id }}</td>
                        <td class="fw-bold">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $song->thumbnail_url ?? 'https://ui-avatars.com/api/?name=Song' }}" width="32" height="32" class="rounded">
                                {{ $song->title }}
                            </div>
                        </td>
                        <td>{{ $song->artist ?? 'Unknown' }}</td>
                        <td>{{ $song->room->name ?? 'Unknown Room' }}</td>
                        <td>{{ $song->user_id ? 'User ID: ' . $song->user_id : 'Host' }}</td>
                        <td class="text-muted">{{ $song->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No songs found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $songs->links() }}
        </div>
    </div>
</x-card>
@endsection
