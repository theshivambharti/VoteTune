@props(['size' => 'md', 'color' => 'primary'])
<div class="spinner-border text-{{ $color }} spinner-border-{{ $size }}" role="status" {!! $attributes !!}>
    <span class="visually-hidden">Loading...</span>
</div>