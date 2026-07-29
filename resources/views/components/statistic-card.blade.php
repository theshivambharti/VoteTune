@props(['title', 'value', 'icon' => 'activity', 'trend' => null, 'trendValue' => null])
<x-card class="h-100">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h6 class="text-secondary mb-1 vt-body-small">{{ $title }}</h6>
            <h3 class="mb-0 vt-h2">{{ $value }}</h3>
        </div>
        <div class="p-2 bg-primary bg-opacity-10 text-primary rounded">
            <i data-lucide="{{ $icon }}"></i>
        </div>
    </div>
    @if($trend)
        <div class="d-flex align-items-center vt-body-small mt-3">
            <span class="badge bg-{{ $trend === 'up' ? 'success' : 'danger' }} bg-opacity-10 text-{{ $trend === 'up' ? 'success' : 'danger' }} me-2">
                <i data-lucide="{{ $trend === 'up' ? 'trending-up' : 'trending-down' }}" style="width: 14px; height: 14px;"></i>
                {{ $trendValue }}
            </span>
            <span class="text-secondary">vs last month</span>
        </div>
    @endif
</x-card>