@props(['time', 'title', 'icon' => 'clock', 'color' => 'primary'])
<div class="timeline-item d-flex mb-4" {!! $attributes !!}>
    <div class="timeline-icon bg-{{ $color }} bg-opacity-10 text-{{ $color }} rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
        <i data-lucide="{{ $icon }}" style="width: 20px; height: 20px;"></i>
    </div>
    <div class="timeline-content">
        <h6 class="mb-1 vt-h4">{{ $title }}</h6>
        <p class="vt-body-small text-secondary mb-2">{{ $time }}</p>
        <div class="vt-body">{{ $slot }}</div>
    </div>
</div>