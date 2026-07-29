@props(['disabled' => false, 'error' => false])
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control vt-input ' . ($error ? 'is-invalid' : '')]) !!}>
@if($error)
    <div class="invalid-feedback">{{ $error }}</div>
@endif