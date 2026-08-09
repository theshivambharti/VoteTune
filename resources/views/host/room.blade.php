@extends('layouts.host')
@section('title', 'Manage Room: ' . $room->name)
@section('header', 'Manage Room')

@section('content')
<div class="row g-4" id="room-app" data-room-id="{{ $room->id }}">
    <div class="col-md-4">
        <x-card class="mb-4">
            <div class="card-body">
                <h5 class="vt-h5 mb-2">{{ $room->name }}</h5>
                <p class="mb-3">
                    <span class="badge bg-secondary font-monospace fs-5 user-select-all">{{ $room->room_code }}</span>
                    <span class="badge {{ $room->status === 'active' ? 'bg-success' : 'bg-danger' }}" id="room-status-badge">
                        {{ ucfirst($room->status) }}
                    </span>
                </p>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-warning w-100" onclick="toggleRoomStatus()">
                        <i data-lucide="power" class="me-1" style="width: 14px;"></i> Toggle Status
                    </button>
                    <a href="{{ route('room.show', $room->room_code) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                        <i data-lucide="external-link" class="me-1" style="width: 14px;"></i> View Public
                    </a>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="card-body">
                <h5 class="vt-h5 mb-3">Add Song</h5>
                <form id="add-song-form" onsubmit="addSong(event)">
                    <div class="mb-3">
                        <label class="form-label">YouTube Video ID or URL</label>
                        <input type="text" class="form-control" id="video-input" required placeholder="e.g. dQw4w9WgXcQ">
                    </div>
                    <button type="submit" class="btn vt-btn vt-btn-primary w-100" id="btn-add-song">
                        <i data-lucide="plus" class="me-2" style="width: 18px;"></i> Add to Playlist
                    </button>
                </form>
            </div>
        </x-card>
    </div>

    <div class="col-md-8">
        <x-card>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="vt-h5 mb-0">Playlist</h5>
                    <span class="badge bg-primary rounded-pill">{{ $room->songs->count() }} songs</span>
                </div>
                
                <div class="list-group" id="song-list">
                    @forelse($room->songs as $song)
                        <div class="list-group-item d-flex align-items-center gap-3 song-item" data-song-id="{{ $song->id }}">
                            @if($song->thumbnail)
                                <img src="{{ $song->thumbnail }}" alt="thumbnail" width="120" class="rounded">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width: 120px; height: 67px;">
                                    <i data-lucide="music" class="text-white"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1 min-w-0">
                                <h6 class="mb-1 text-truncate">{{ $song->title }}</h6>
                                <p class="mb-0 text-muted small text-truncate">{{ $song->channel }} • {{ $song->duration }}</p>
                            </div>
                            <div class="text-center px-3 border-start border-end">
                                <div class="fs-4 fw-bold text-primary vote-count" id="vote-count-{{ $song->id }}">{{ $song->votes_count }}</div>
                                <div class="small text-muted">Votes</div>
                            </div>
                            <button class="btn btn-sm btn-outline-danger border-0" onclick="removeSong({{ $song->id }})" title="Remove Song">
                                <i data-lucide="trash-2"></i>
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted" id="empty-state">
                            <i data-lucide="music-4" class="mb-3 opacity-50" style="width: 48px; height: 48px;"></i>
                            <p>No songs added yet. Start by adding a YouTube video!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </x-card>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const roomId = {{ $room->id }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Extract video ID from YouTube URL
    function extractVideoId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : url; // If not a URL, assume it's already an ID
    }

    async function addSong(e) {
        e.preventDefault();
        const input = document.getElementById('video-input');
        const btn = document.getElementById('btn-add-song');
        const videoId = extractVideoId(input.value.trim());

        if (videoId.length !== 11) {
            Swal.fire('Invalid Input', 'Please enter a valid YouTube Video ID or URL.', 'error');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Adding...';

        try {
            const res = await fetch(`/host/room/${roomId}/song`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ video_id: videoId })
            });
            const data = await res.json();

            if (data.success) {
                // Reload page to show new song
                window.location.reload();
            } else {
                Swal.fire('Error', data.message || 'Failed to add song.', 'error');
            }
        } catch (err) {
            Swal.fire('Error', 'Network error occurred.', 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i data-lucide="plus" class="me-2" style="width: 18px;"></i> Add to Playlist';
            lucide.createIcons();
        }
    }

    async function removeSong(songId) {
        const result = await Swal.fire({
            title: 'Remove Song?',
            text: "This will also delete all votes for this song.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes, remove it'
        });

        if (result.isConfirmed) {
            try {
                const res = await fetch(`/host/room/${roomId}/song/${songId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                const data = await res.json();
                if (data.success) {
                    window.location.reload();
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            } catch (err) {
                Swal.fire('Error', 'Network error occurred.', 'error');
            }
        }
    }

    async function toggleRoomStatus() {
        const currentStatus = '{{ $room->status }}';
        const newStatus = currentStatus === 'active' ? 'closed' : 'active';
        
        try {
            const res = await fetch(`/host/room/${roomId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ status: newStatus })
            });
            const data = await res.json();
            if (data.success) {
                window.location.reload();
            } else {
                Swal.fire('Error', 'Failed to update status.', 'error');
            }
        } catch (err) {
            Swal.fire('Error', 'Network error occurred.', 'error');
        }
    }

    // Reverb Live Updates
    if (typeof Echo !== 'undefined') {
        Echo.channel(`room.${roomId}`)
            .listen('VoteCast', (e) => {
                const counter = document.getElementById(`vote-count-${e.songId}`);
                if (counter) {
                    counter.innerText = e.voteCount;
                    // Flash effect
                    counter.classList.add('text-success');
                    setTimeout(() => counter.classList.remove('text-success'), 1000);
                }
            });
    }
</script>
@endpush
