@props(['disabled' => false, 'error' => false])
<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control vt-input ' . ($error ? 'is-invalid' : '')]) !!}>{{ $slot }}</textarea>
@if($error)
    <div class="invalid-feedback">{{ $error }}</div>
@endif