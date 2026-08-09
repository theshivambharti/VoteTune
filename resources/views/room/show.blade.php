@extends('layouts.app')
@section('title', $room->name . ' - VoteTune')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-4">
                <h1 class="vt-h2 mb-2">{{ $room->name }}</h1>
                <p class="text-muted">
                    Room Code: <span class="badge bg-secondary font-monospace fs-5">{{ $room->room_code }}</span>
                </p>
                @if($room->status !== 'active')
                    <div class="alert alert-warning d-inline-block">
                        This room is currently closed for voting.
                    </div>
                @endif
            </div>

            <div class="list-group shadow-sm" id="public-song-list">
                @forelse($room->songs as $song)
                    @php
                        // Check if the current user/guest has voted for this song
                        $hasVoted = $song->votes->contains('voter_identifier', $voterIdentifier);
                    @endphp
                    <div class="list-group-item d-flex align-items-center gap-3 py-3 song-item">
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
                        
                        <div class="text-center px-3 border-start">
                            <div class="fs-4 fw-bold text-primary vote-count" id="vote-count-{{ $song->id }}">{{ $song->votes_count }}</div>
                            <div class="small text-muted">Votes</div>
                        </div>

                        <div>
                            <button 
                                class="btn btn-lg {{ $hasVoted ? 'btn-primary' : 'btn-outline-primary' }} rounded-circle p-0 d-flex align-items-center justify-content-center vote-btn" 
                                style="width: 48px; height: 48px;"
                                onclick="toggleVote({{ $song->id }}, this)"
                                data-voted="{{ $hasVoted ? 'true' : 'false' }}"
                                {{ $room->status !== 'active' ? 'disabled' : '' }}
                            >
                                <i data-lucide="thumbs-up" class="{{ $hasVoted ? 'text-white' : '' }}"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i data-lucide="music-4" class="mb-3 opacity-50" style="width: 48px; height: 48px;"></i>
                        <p>No songs have been added to this room yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const roomId = {{ $room->id }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    async function toggleVote(songId, btnElement) {
        const isVoted = btnElement.getAttribute('data-voted') === 'true';
        
        // Optimistic UI update
        const countEl = document.getElementById(`vote-count-${songId}`);
        let currentCount = parseInt(countEl.innerText);
        
        if (isVoted) {
            btnElement.classList.replace('btn-primary', 'btn-outline-primary');
            btnElement.querySelector('i').classList.remove('text-white');
            btnElement.setAttribute('data-voted', 'false');
            countEl.innerText = currentCount - 1;
        } else {
            btnElement.classList.replace('btn-outline-primary', 'btn-primary');
            btnElement.querySelector('i').classList.add('text-white');
            btnElement.setAttribute('data-voted', 'true');
            countEl.innerText = currentCount + 1;
        }

        try {
            const res = await fetch(`/r/${roomId}/song/${songId}/vote`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            const data = await res.json();
            
            if (!data.success) {
                // Revert optimistic update
                if (isVoted) {
                    btnElement.classList.replace('btn-outline-primary', 'btn-primary');
                    btnElement.querySelector('i').classList.add('text-white');
                    btnElement.setAttribute('data-voted', 'true');
                    countEl.innerText = currentCount;
                } else {
                    btnElement.classList.replace('btn-primary', 'btn-outline-primary');
                    btnElement.querySelector('i').classList.remove('text-white');
                    btnElement.setAttribute('data-voted', 'false');
                    countEl.innerText = currentCount;
                }
                Swal.fire('Error', data.message || 'Failed to vote.', 'error');
            }
        } catch (err) {
            // Revert optimistic update
            window.location.reload();
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
