@props(['icon' => 'inbox', 'title', 'description' => ''])
<div class="text-center py-5" {!! $attributes !!}>
    <div class="d-inline-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-secondary rounded-circle mb-3" style="width: 80px; height: 80px;">
        <i data-lucide="{{ $icon }}" style="width: 40px; height: 40px;"></i>
    </div>
    <h4 class="vt-h3 mb-2">{{ $title }}</h4>
    @if($description)
        <p class="text-secondary vt-body mb-4">{{ $description }}</p>
    @endif
    {{ $slot }}
</div>