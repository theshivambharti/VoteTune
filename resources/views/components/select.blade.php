@props(['disabled' => false, 'error' => false])
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-select vt-input ' . ($error ? 'is-invalid' : '')]) !!}>
    {{ $slot }}
</select>
@if($error)
    <div class="invalid-feedback">{{ $error }}</div>
@endif