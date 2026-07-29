@props(['id', 'title', 'placement' => 'end'])
<div class="offcanvas offcanvas-{{ $placement }} vt-card border-0 rounded-0" tabindex="-1" id="{{ $id }}" aria-labelledby="{{ $id }}Label" {!! $attributes !!}>
    <div class="offcanvas-header border-bottom-0 pb-0 pt-4 px-4">
        <h5 class="offcanvas-title vt-h4" id="{{ $id }}Label">{{ $title }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4">
        {{ $slot }}
    </div>
</div>