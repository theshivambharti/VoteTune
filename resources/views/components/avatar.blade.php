@props(['src' => null, 'alt' => 'Avatar', 'size' => '40px', 'initials' => 'U'])
<div class="avatar d-inline-flex align-items-center justify-content-center bg-secondary text-white rounded-circle flex-shrink-0" style="width: {{ $size }}; height: {{ $size }}; font-size: calc({{ $size }} * 0.4);" {!! $attributes !!}>
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="rounded-circle w-100 h-100 object-fit-cover">
    @else
        <span>{{ $initials }}</span>
    @endif
</div>