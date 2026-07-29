@props(['disabled' => false, 'label' => '', 'id' => uniqid('rad_')])
<div class="form-check">
    <input class="form-check-input vt-focus-ring" type="radio" id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes !!}>
    @if($label)
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @else
        <label class="form-check-label" for="{{ $id }}">{{ $slot }}</label>
    @endif
</div>