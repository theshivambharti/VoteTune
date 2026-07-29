@props(['type' => 'info', 'dismissible' => false, 'icon' => ''])
<div {{ $attributes->merge(['class' => "alert alert-$type vt-radius-md border-0 " . ($dismissible ? 'alert-dismissible fade show' : '')]) }} role="alert">
    <div class="d-flex align-items-center">
        @if($icon)
            <i data-lucide="{{ $icon }}" class="me-2"></i>
        @endif
        <div>{{ $slot }}</div>
    </div>
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>