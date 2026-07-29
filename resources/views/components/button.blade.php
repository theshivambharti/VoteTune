<button {{ $attributes->merge(['class' => 'btn vt-btn ' . ($class ?? '')]) }}>
    {{ $slot }}
</button>