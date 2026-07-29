@props(['type' => 'primary'])
<span {{ $attributes->merge(['class' => "badge bg-$type vt-radius-sm"]) }}>
    {{ $slot }}
</span>