@props(['title', 'description' => ''])
<div class="d-flex justify-content-between align-items-center mb-4" {!! $attributes !!}>
    <div>
        <h1 class="vt-h2 mb-1">{{ $title }}</h1>
        @if($description)
            <p class="text-secondary mb-0 vt-body">{{ $description }}</p>
        @endif
    </div>
    @if(isset($actions))
        <div class="d-flex gap-2">
            {{ $actions }}
        </div>
    @endif
</div>