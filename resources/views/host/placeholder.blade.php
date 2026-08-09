@extends('layouts.host')
@section('title', $title . ' - Host Dashboard')
@section('header', $title)
@section('content')
<x-card>
    <div class="card-body text-center py-5">
        <div class="mb-4">
            <i data-lucide="wrench" class="text-muted" style="width: 48px; height: 48px;"></i>
        </div>
        <h3 class="vt-h3 mb-3">{{ $title }} Management</h3>
        <p class="text-muted mb-0">This module is currently under development. The necessary routing and architecture have been configured.</p>
    </div>
</x-card>
@endsection
