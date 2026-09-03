@extends('layouts.app')
@section('title', 'My Dashboard - VoteTune')
@section('header', 'Dashboard')
@section('content')

<!-- Welcome & Primary Action -->
<div class="row mb-5 align-items-center">
    <div class="col-md-7">
        <h3 class="fw-bold mb-2">Hello, {{ auth()->user()->name }}! 👋</h3>
        <p class="text-muted vt-body-large mb-0">Ready to decide what plays next?</p>
    </div>
    <div class="col-md-5 text-md-end mt-4 mt-md-0">
        <button class="btn vt-btn vt-btn-primary btn-lg shadow-sm w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#joinRoomModal">
            <i data-lucide="log-in" class="me-2" style="width: 20px;"></i> Join a Room
        </button>
    </div>
</div>

<div class="row g-4">
    <!-- Active Rooms you're in -->
    <div class="col-lg-8">
        <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
            <i data-lucide="radio" class="text-primary" style="width: 20px;"></i> Recent Active Rooms
        </h5>
        
        @if($recentRooms->isEmpty())
            <x-card class="border-0 shadow-sm bg-body-tertiary">
                <div class="card-body text-center py-5">
                    <div class="mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 64px; height: 64px;">
                            <i data-lucide="music" style="width: 32px; height: 32px;"></i>
                        </div>
                    </div>
                    <h5>No recent rooms found</h5>
                    <p class="text-muted mb-4">You haven't participated in any active rooms recently.</p>
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#joinRoomModal">Join your first room</button>
                </div>
            </x-card>
        @else
            <div class="row g-3">
                @foreach($recentRooms as $room)
                    <div class="col-md-6">
                        <x-card class="h-100 border-0 shadow-sm hover-lift transition-all">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h6 class="fw-bold mb-0 text-truncate">{{ $room->name }}</h6>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">Active</span>
                                </div>
                                <div class="mb-4">
                                    <span class="text-muted small">Host: {{ $room->host->name ?? 'Unknown' }}</span>
                                </div>
                                <a href="{{ route('room.show', $room->room_code) }}" class="btn vt-btn btn-sm btn-light w-100 fw-semibold">
                                    Enter Room
                                </a>
                            </div>
                        </x-card>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Your Stats & Recent Votes -->
    <div class="col-lg-4">
        <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
            <i data-lucide="bar-chart-2" class="text-primary" style="width: 20px;"></i> Your Activity
        </h5>
        
        <x-card class="border-0 shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="row g-0 text-center">
                    <div class="col-6 border-end p-3">
                        <h3 class="fw-bold text-primary mb-1">{{ number_format($stats['total_votes']) }}</h3>
                        <span class="text-muted small fw-semibold text-uppercase letter-spacing-1">Songs Voted</span>
                    </div>
                    <div class="col-6 p-3">
                        <h3 class="fw-bold text-primary mb-1">{{ number_format($stats['rooms_participated']) }}</h3>
                        <span class="text-muted small fw-semibold text-uppercase letter-spacing-1">Rooms Joined</span>
                    </div>
                </div>
            </div>
        </x-card>
        
        <h6 class="fw-bold mb-3 mt-4 text-muted small text-uppercase">Recent Votes</h6>
        
        @if($recentVotes->isEmpty())
            <div class="text-center p-4 bg-body-tertiary rounded">
                <p class="text-muted small mb-0">No voting history yet.</p>
            </div>
        @else
            <div class="list-group list-group-flush border-0 shadow-sm rounded">
                @foreach($recentVotes as $vote)
                    <div class="list-group-item p-3 border-bottom-0 mb-1 rounded bg-body">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $vote->song->thumbnail_url ?? 'https://ui-avatars.com/api/?name=Song&color=7F9CF5&background=EBF4FF' }}" alt="Song Cover" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                            <div class="flex-grow-1 overflow-hidden">
                                <h6 class="mb-0 text-truncate fw-semibold">{{ $vote->song->title ?? 'Unknown Song' }}</h6>
                                <div class="text-muted small text-truncate">
                                    {{ $vote->room->name ?? 'Unknown Room' }} &bull; {{ $vote->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Join Room Modal -->
<div class="modal fade" id="joinRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="joinRoomModalLabel">Join a Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                
                <!-- QR Scanner View (Hidden by default) -->
                <div id="qrScannerView" class="d-none text-center">
                    <div id="reader" style="width: 100%; border-radius: 8px; overflow: hidden; margin-bottom: 15px;"></div>
                    <p class="text-muted small">Point your camera at a VoteTune room QR code.</p>
                    <p id="qrError" class="text-danger small fw-bold d-none">That QR code isn't a valid VoteTune room.</p>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btnManualCode">Enter code manually</button>
                </div>

                <!-- Manual Code View -->
                <div id="manualCodeView">
                    <div class="mb-3">
                        <label for="room_code" class="form-label fw-semibold">Enter Room Code</label>
                        <input type="text" class="form-control form-control-lg font-monospace text-center letter-spacing-2" id="room_code" placeholder="e.g. A1B2C3" autofocus>
                    </div>
                    <div class="text-center text-muted small mb-3">Or</div>
                    <button type="button" class="btn btn-outline-secondary w-100 fw-semibold" id="btnScanQr">
                        <i data-lucide="qr-code" class="me-2" style="width: 18px;"></i> Scan QR Code
                    </button>
                </div>

            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn vt-btn vt-btn-primary px-4" id="btnJoinRoom">Join</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let html5QrcodeScanner = null;
    const qrScannerView = document.getElementById('qrScannerView');
    const manualCodeView = document.getElementById('manualCodeView');
    const btnScanQr = document.getElementById('btnScanQr');
    const btnManualCode = document.getElementById('btnManualCode');
    const qrError = document.getElementById('qrError');
    const roomCodeInput = document.getElementById('room_code');
    const btnJoinRoom = document.getElementById('btnJoinRoom');
    const modal = document.getElementById('joinRoomModal');

    function stopScanner() {
        if (html5QrcodeScanner) {
            html5QrcodeScanner.clear().catch(error => {
                console.error("Failed to clear html5QrcodeScanner. ", error);
            });
            html5QrcodeScanner = null;
        }
    }

    function onScanSuccess(decodedText, decodedResult) {
        qrError.classList.add('d-none');
        
        let code = decodedText.trim();
        
        // If it's a URL, extract the code part
        try {
            if (code.includes('/r/')) {
                const url = new URL(code);
                const parts = url.pathname.split('/');
                code = parts[parts.length - 1];
            }
        } catch (e) {
            // Not a URL, use as is
        }

        // Basic validation: just ensure it's alphanumeric and not too long
        if (/^[A-Za-z0-9_-]{4,20}$/.test(code)) {
            stopScanner();
            roomCodeInput.value = code;
            window.location.href = '/r/' + code;
        } else {
            qrError.classList.remove('d-none');
        }
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
    }

    btnScanQr.addEventListener('click', function() {
        manualCodeView.classList.add('d-none');
        qrScannerView.classList.remove('d-none');
        document.getElementById('joinRoomModalLabel').innerText = 'Scan QR Code';
        
        html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250}, aspectRatio: 1.0 },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    });

    btnManualCode.addEventListener('click', function() {
        stopScanner();
        qrScannerView.classList.add('d-none');
        manualCodeView.classList.remove('d-none');
        qrError.classList.add('d-none');
        document.getElementById('joinRoomModalLabel').innerText = 'Join a Room';
    });

    btnJoinRoom.addEventListener('click', function() {
        const code = roomCodeInput.value.trim();
        if (code) {
            window.location.href = '/r/' + code;
        }
    });

    // Cleanup scanner when modal is closed
    modal.addEventListener('hidden.bs.modal', function () {
        stopScanner();
        qrScannerView.classList.add('d-none');
        manualCodeView.classList.remove('d-none');
        qrError.classList.add('d-none');
        roomCodeInput.value = '';
        document.getElementById('joinRoomModalLabel').innerText = 'Join a Room';
    });
});
</script>
@endpush
@endsection
