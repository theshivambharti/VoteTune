@extends('layouts.admin')
@section('title', 'Votes - Admin Dashboard')
@section('header', 'Votes')
@section('content')
<x-card>
    <div class="card-body">
        <h5 class="vt-h5 mb-4">All Votes</h5>
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User / Guest</th>
                        <th>Song</th>
                        <th>Room</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($votes as $vote)
                    <tr>
                        <td>{{ $vote->id }}</td>
                        <td class="fw-bold">
                            @if($vote->user)
                                {{ $vote->user->name }}
                            @else
                                <span class="text-muted">Guest ({{ substr($vote->session_id, 0, 8) }}...)</span>
                            @endif
                        </td>
                        <td>{{ $vote->song->title ?? 'Unknown' }}</td>
                        <td>{{ $vote->room->name ?? 'Unknown Room' }}</td>
                        <td class="text-muted">{{ $vote->created_at->format('M d, Y H:i:s') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No votes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $votes->links() }}
        </div>
    </div>
</x-card>
@endsection
