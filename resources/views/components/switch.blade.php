@props(['disabled' => false, 'label' => '', 'id' => uniqid('sw_')])
<div class="form-check form-switch">
    <input class="form-check-input vt-focus-ring" type="checkbox" role="switch" id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes !!}>
    @if($label)
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @else
        <label class="form-check-label" for="{{ $id }}">{{ $slot }}</label>
    @endif
</div>