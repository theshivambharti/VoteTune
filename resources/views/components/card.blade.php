<div {{ $attributes->merge(['class' => 'vt-card ' . ($class ?? '')]) }}>
    @if(isset($header))
        <div class="card-header bg-transparent border-bottom-0 pb-0 pt-4 px-4">
            {{ $header }}
        </div>
    @endif
    <div class="card-body p-4">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="card-footer bg-transparent border-top-0 pt-0 pb-4 px-4">
            {{ $footer }}
        </div>
    @endif
</div>