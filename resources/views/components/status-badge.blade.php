@props(['status'])
@php
    $type = match(strtolower($status)) {
        'active', 'completed', 'success' => 'success',
        'pending', 'processing', 'warning' => 'warning',
        'failed', 'cancelled', 'danger' => 'danger',
        default => 'secondary'
    };
@endphp
<x-badge type="{{ $type }}" {!! $attributes !!}>
    {{ ucfirst($status) }}
</x-badge>