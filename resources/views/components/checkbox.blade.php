@props(['disabled' => false, 'label' => '', 'id' => uniqid('chk_')])
<div class="form-check">
    <input class="form-check-input vt-focus-ring" type="checkbox" id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes !!}>
    @if($label)
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @else
        <label class="form-check-label" for="{{ $id }}">{{ $slot }}</label>
    @endif
</div>