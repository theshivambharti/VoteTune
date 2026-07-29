@props(['id' => uniqid('dd_'), 'align' => 'end', 'label' => 'Dropdown'])
<div class="dropdown">
    <button class="btn vt-btn btn-secondary dropdown-toggle" type="button" id="{{ $id }}" data-bs-toggle="dropdown" aria-expanded="false" {!! $attributes !!}>
        @if(isset($trigger))
            {{ $trigger }}
        @else
            {{ $label }}
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-{{ $align }} vt-card border-0 shadow-sm mt-2" aria-labelledby="{{ $id }}">
        {{ $slot }}
    </ul>
</div>