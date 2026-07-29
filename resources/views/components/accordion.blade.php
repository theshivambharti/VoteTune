@props(['id' => uniqid('acc_')])
<div class="accordion" id="{{ $id }}" {!! $attributes !!}>
    {{ $slot }}
</div>